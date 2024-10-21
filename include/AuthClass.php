<?php
class AuthClass
{
    public function CheckLogIn(){
        $arrLogin=array(true, "Login Success");
        if (!isset($_SESSION["adminfb"]["LOGIN"]) || $_SESSION["adminfb"]["LOGIN"] !== true) {
            $arrLogin = array(false, "No Login");
        }

        if ($_SESSION["adminfb"]["DATA"]["Username"] === "") {
            $arrLogin = array(false, "No Username");
        }

        if ($arrLogin[0]===false) {
//            header("location: ../index.php");
            ?><script>window.location.assign("index.php")</script><?php
            exit;
        }
    }

    function GetUsername(){
        return $_SESSION["adminfb"]["DATA"]["Username"];
    }

    function GetAgent(){
        return $_SESSION["adminfb"]["DATA"]["AgentCode"];
    }
}
