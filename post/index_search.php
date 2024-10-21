<?php
include '../layouts/session.php';
include "../include/ConnectGo.php";
include "../include/AuthClass.php";
include "../include/function.php";

$action = $_POST["action"];

if($action === "CHECK_LOGIN"){
    $Auth = new AuthClass();
    $Data = $Auth->CheckLogIn();

    echo '<pre>';var_dump($Data);echo '</pre>';
}

if($action === "LogIn"){

    $API = new ApiGo();
    $Param = array();
    $Param['Username'] = strtolower($_POST["username"]);
    $Param['Password'] = $_POST["password"];
    $Param['DoIp'] = GetIp();
    $Param['DoAdmin'] = strtolower($_POST["username"]);
    $RES = $API->GetApi("SuperAdmin/Login",$Param);
//    echo '<pre>';var_dump($RES);echo '</pre>';

    if($RES["Result"] === true){
        $_SESSION["adminfb"]["LOGIN"] = true;
        $_SESSION["adminfb"]["DATA"] = $RES["Data"];
//        $_SESSION["ADMIN_OS"]["DATA"]["PASSWORD"] = $_POST["password"];
        $_SESSION["adminfb"]["DATA"]["DateLast"] = date("d-m-Y H:i:s");

        if (isset($_POST['auth-remember-check'])) {
            // กำหนดค่า Cookie สำหรับจำข้อมูลผู้ใช้
            setcookie('username', $Param['Username'], time() + (86400 * 30), "/"); // 86400 = 1 วัน
        } else {
            // ลบ Cookie หากไม่ได้เลือก Remember Me
            setcookie('username', '', time() - 3600, "/");
        }

    }
    $Data = array(
        "result" => $RES["Result"],
        "remark" => $RES["Remark"],
    );
    echo json_encode($Data);
}

if($action === "LogOut"){
//    echo '<pre>';var_dump($_POST);echo '</pre>';
    unset($_SESSION["adminfb"]);
//    header("location: index.php");
//    exit;
    $res =  array(
            "Result" => true
    );
    echo json_encode($res);
}