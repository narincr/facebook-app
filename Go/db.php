<?php
date_default_timezone_set("Asia/Bangkok");
ini_set('display_errors', 'on');
$DB = array();
$DB["host"] = "192.168.99.51";
$DB["username"] = "root";
$DB["password"] = "DataBet88*#a";
$DB["database"] = "MoneyCircle";
$DB["port"] = "3306";


function Connect()
{
    // Extension : MySQLi
    global $DB;
    $conn = mysqli_connect($DB["host"], $DB["username"], $DB["password"], $DB["database"], $DB["port"]);
    mysqli_set_charset($conn, "utf8");
    if (mysqli_connect_errno()) {
        echo "Database Connect Failed : " . mysqli_connect_error();
    } else {
        return $conn;
    }
}


function Query($sql): array
{
    $conn = Connect();
    $query = mysqli_query($conn, $sql);
    $result_array = array();
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $result_array[] = $result;
    }
    mysqli_close($conn);
    mysqli_free_result($query);
    return $result_array;
}