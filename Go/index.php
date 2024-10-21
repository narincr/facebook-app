<?php
include("db.php");
?>
    <form action="index.php" method="post">
        Table Name : <input type="text" name="Table" onclick="this.select();" value="<?php echo $_POST["Table"]; ?>">
        <input type="hidden" name="action" value="Generate">
        <button type="submit">Generate</button>
    </form>

    <hr>

<?php
if ($_POST["action"] == "Generate") {
    $Table = $_POST["Table"];
    print "Table : " . $Table;
    print "<br>";
    if ($Table == "") {
        print "Table is Empty";
        exit();
    }

    $sql = "describe " . $Table;
    $res = Query($sql);

    if (empty(count($res))) {
        print "Error Table Description";
        exit();
    }

    $PP = "";
    $P1 = "";

    $P2 = "type ".$Table." struct { \r\n";
    foreach ($res as $rs) {
        $PP .= $rs["Field"] . ' := c.PostForm("' . $rs["Field"] . '")';
        $PP .= "\r\n";


        $P1 .= 'if ' . $rs["Field"] . ' == "" {';
        $P1 .= "\r\n";
        $P1 .= ' c.JSON(http.StatusBadRequest, gin.H{"Result": false, "Remark": "กรุณาระบุ ' . $rs["Field"] . '", "Error": "Empty|' . $rs["Field"] . '"})';
        $P1 .= "\r\n";
        $P1 .= 'return';
        $P1 .= "\r\n";
        $P1 .= '}';
        $P1 .= "\r\n";

        $P2 .= $rs["Field"].'  string `gorm:"column:' . $rs["Field"] . '"`';
        $P2 .= "\r\n";
    }
    $P2 .= "}\r\n";
    ?>

    <textarea rows="20" cols="50"><?php print $PP; ?></textarea>
    <textarea rows="20" cols="120"><?php print $P1; ?></textarea>
    <br>
    <textarea rows="20" cols="50"><?php print $P2; ?></textarea>


    <?php

    print "<pre>";
    print_r($res);
    print "</pre>";

}
?>