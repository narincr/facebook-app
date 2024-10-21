<?php
// function systems

function msg_success($text="บันทึกรายการสำเร็จ"){
    ?>
    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <!-- <strong>Oh snap!</strong> -->
        <i class="fas fa-check-circle"></i> <?=$text?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}

function msg_error($text="ไม่พบข้อมูล"){
    ?>
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <!-- <strong>Oh snap!</strong> -->
        <i class="fas fa-exclamation-circle"></i> <?=$text?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}

function se($string) // ตัดอักขระพิเศษ
{ // ป้องกัน SQL Injection
    $string = trim($string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9ก-๙\-_.#@!$%^&+|[](){}*\/]/', '', $string); // Removes special chars.
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

//    echo "<pre>",print_r($diff),"</pre>";
//    $diff->w = floor($diff->d / 7);
//    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'ปี',
        'm' => 'เดือน',
//        'w' => 'สัปดาห์',
        'd' => 'วัน',
        'h' => 'ชั่วโมง',
        'i' => 'นาที',
        's' => 'วินาที',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ที่ผ่านมา' : 'ตอนนี้';
}

function fullDate($x){
    if(trim($x)!=''){
        $date=date_create($x);
        return date_format($date,"d/m/Y H:i:s");
    }else{
        return '';
    }
}

function shortDate($x){
    $date=date_create($x);
    return date_format($date,"d/m/Y");
}

function engFullDate($x){
    $date=date_create($x);
    return date_format($date,"Y-m-d H:i:s");
}

function engDate($x){
    $date=date_create($x);
    return date_format($date,"Y-m-d");
}

function thFullDate($x){
    $date=date_create($x);
    return date_format($date,"d-m-Y H:i:s");
}

function thDate($x){
    $date=date_create($x);
    return date_format($date,"d-m-Y");
}


function timeOnly($x){
    $date=date_create($x);
    return date_format($date,"H:i:s");
}

function ShowDate($full_datetime)
{

    $full_datetime=date_format(date_create($full_datetime),"Y-m-d H:i:s");
    $ex = explode(' ', $full_datetime);
    $count_ex = count($ex);
    if ($count_ex == 1) {
        // มีเฉพาะวันที่ ให้ทำรายการเรียงใหม่ แล้วส่งไปแสดงเลย
        $exd = explode('-', $ex[0]);
        $full_return = $exd[2] . '/' . $exd[1] . '/' . $exd[0];
    } else {
        if (date('Y-m-d') == $ex[0]) {
            // ถ้าเป็นวันเดียวกัน ไม่ต้องแสดง ให้แสดงเฉพาะเวลา
            $full_return = substr($ex[1], 0, 5);
        } else {
            // เป็นวันที่ก่อนหน้านี้
            $exd = explode('-', $ex[0]);
            $full_dd = $exd[2] . '/' . $exd[1] . '/' . $exd[0];
            $full_time = substr($ex[1], 0, 5);
            $full_return = $full_dd . ' ' . $full_time;
        }
    }

    return $full_return;
}




function replaceMobile($mess){
    // $chk = this->patturnDefaultPass();
    // $mess = "User: dtk94183 , Pass : Dt@0839429610 , เครดิตพร้อมเล่น: 100 บาท , เข้าระบบได้ที่ : databet63.com";
    $pat = "";
    $strFind = "";
    $p = 0;
    $arr = array("/[Dt]{2}[@][0-9]{10}/","/[Dt]{2}[0-9]{10}[@]/");
    $arrNum = array('0','1','2','3','4','5','6','7','8','9');
    foreach($arr as $a){
        $c = preg_match($a, $mess, $matches);

        if($c > 0){
            $p++;
            $strFind = $matches[0];
            $txtReplace = str_replace($arrNum, 'x', $matches[0]);
        }
    }


    if($p > 0){
        $result = str_replace($strFind, $txtReplace, $mess);
    }else{
        $result = $mess;
    }

    return $result;
}

function MaskMobile($mobile)
{
    $pre = substr($mobile, 0, 3);
    $aft = substr($mobile, 6, 4);
    $mobile_number = $pre . "-xxx-" . $aft;
    return $mobile_number;
}

function MaskLine($line_id)
{
    $pre = substr($line_id, 0, 3);
    $line_id_return = $pre . "______";
    return $line_id_return;
}


function GetIP()
{
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
            $addr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


function ShortText($x,$len = 50){
    // ตรวจสอบว่าข้อความมีความยาวเกิน 50 ตัวอักษรหรือไม่
    if (iconv_strlen(strip_tags($x), 'UTF-8') > intval($len)) {
        $txt = iconv_substr(strip_tags($x), 0, intval($len), 'UTF-8') . "...";
    } else {
        $txt = strip_tags($x); // ถ้าไม่เกิน 50 ตัวอักษร ให้คืนค่าตามเดิม
    }
    return $txt;
}



function GetUsername(){
    return $_SESSION['PAY_OS']['DATA']['Username'];
}

function GetAgent(){
    return $_SESSION['PAY_OS']['DATA']['AgentCode'];
}

function iconStatus($status){
    $icon_status = "";
    if(trim($status) != ""){
        if($status == "Y"){
            $icon_status = '<i class="bi bi-check-square-fill text-success fs-1"></i>';
        }else{
            $icon_status = '<i class="bi bi-record-circle-fill text-danger fs-1"></i>';
        }
    }
    return $icon_status;
}

function labelStatusWinth($status){
    $icon_status = "";
    if(trim($status) != ""){
        if($status == "0"){
            $icon_status = '<span class="badge badge-primary">ไม่ทำรายการเนื่องจากไม่ใช่ระบบออโต้</span>';
        }
        if($status == "1"){
            $icon_status = '<span class="badge badge-primary">รอคิวโอนเงิน</span>';
        }
        if($status == "2"){
            $icon_status = '<span class="badge badge-primary">กำลังทำรายการโอนเงิน</span>';
        }
        if($status == "3"){
            $icon_status = '<span class="badge badge-primary">โอนเงินไม่สำเร็จ</span>';
        }
        if($status == "4"){
            $icon_status = '<span class="badge badge-primary">โอนเงินสำเร็จแล้ว</span>';
        }
        if($status == "5"){
            $icon_status = '<span class="badge badge-primary">อื่น ๆ</span>';
        }
    }
    return $icon_status;
}

function labelBankType($status){
    $icon_status = "";
    if(trim($status) != ""){
        if($status == "I"){
            $icon_status = '<span class="badge badge-success">บัญชีฝาก</span>';
        }
        if($status == "O"){
            $icon_status = '<span class="badge badge-danger">บัญชีถอน</span>';
        }
        if($status == "S"){
            $icon_status = '<span class="badge badge-warning">บัญชีซัพ</span>';
        }
    }
    return $icon_status;
}

function SetColorBankCode($cod){
    $list = array(
        "BAAC" => "text-success",
        "BAY" => "text-warning",
        "BBL" => "text-success",
        "CIMB" => "text-success",
        "GHB" => "text-success",
        "GSB" => "text-danger",
        "IBANK" => "text-success",
        "ICBC" => "text-success",
        "IIEO" => "text-success",
        "KBANK" => "text-success",
        "KKP" => "text-success",
        "KTB" => "text-info",
        "LHBANK" => "text-success",
        "SCB" => "text-primary",
        "STANDARD" => "text-success",
        "THANACHART" => "text-success",
        "TISCO" => "text-success",
        "TMB" => "text-success",
        "TTB" => "text-success",
        "UOB" => "text-success",
        "" => "text-success",
    );

    return $list[$cod];
}

function StatusIsMatch(){
    return $LIST_STSTUS = array(
        "Y"=>"จับคู่แล้ว",
        "N"=>"รอยืนยัน",
    );
}

function IsStatusPSDep($x){
    $rs="";
    if($x == "A"){
        $rs = "รอการชำระเงิน";
    }else if($x == "B"){
        $rs = "ชำระเงินแล้ว";
    }else if($x == "C"){
        $rs = "หมดเวลา ยกเลิกรายการ";
    }else{
        $rs = "ไม่พบข้อมูล";
    }
    return $rs;
}
function UseTypePSDep($x){
    $rs="";
    if($x == "A"){
        $rs = "API Payment";
    }else if($x == "B"){
        $rs = "Bank Normal";
    }else{
        $rs = "ไม่พบข้อมูล";
    }
    return $rs;
}

function showDoName($search,$data){
    if(sizeof($data)>0){
        foreach($data as $rs){
            if($rs['DoCode'] == $search){
                return $rs['DoName'];
            }
        }
    }
}

function colorUseType($x){
    $rs="";
    if($x == "A"){
        $rs = "text-warning";
    }else if($x == "B"){
        $rs = "text-success";
    }else if($x == "C"){
        $rs = "text-danger";
    }else{
        $rs = "";
    }
    return $rs;
}

function callbackAction($x){
    $rs="";
    if($x == "DepositOrder.Create"){
        $rs = "<span class='text-primary'>สร้างคำขอ</span>";
    }else if($x == "DepositOrder.Success"){
        $rs = "<span class='text-success'>ชำระเงินเรียบร้อย</span>";
    }else if($x == "DepositOrder.Cancel"){
        $rs = "<span class='text-danger'>ยกเลิก</span>";
    }else{
        $rs = "";
    }
    return $rs;
}

function psBankType($x){
    $rs="";
    if($x == "B"){
        $rs = "บัญชี Payment";
    }else if($x == "A"){
        $rs = "บัญชีธรรมดา";
    }else{
        $rs = "";
    }
    return $rs;
}

function psBankTypeCode($x){
    $rs="";
    if($x == "A"){
        $rs = "Stripe";
    }else if($x == "B"){
        $rs = "Omise";
    }else if($x == "O"){
        $rs = "บัญชีธรรมดา";
    }else{
        $rs = "";
    }
    return $rs;
}

function allStatus($x){
    $rs="";
    if($x == "Y"){
        $rs = "<span class='text-success'>ใช้งาน</span>";
    }else if($x == "N"){
        $rs = "<span class='text-danger'>ปิดใช้งาน</span>";
    }else{
        $rs = "";
    }
    return $rs;
}

function IsStatusBill($x){
    $rs="";
    if($x == "A"){
        $rs = "<span class='text-primary'>สร้างคำขอ</span>";
    }else if($x == "B"){
        $rs = "<span class='text-warning'>รอการชำระเงิน</span>";
    }else if($x == "C"){
        $rs = "<span class='text-danger'>ยกเลิก</span>";
    }else if($x == "D"){
        $rs = "<span class='text-success'>ชำระเรียบร้อยแล้ว</span>";
    }else{
        $rs = "";
    }
    return $rs;
}

function IsPayChoiceBill($x){
    $rs="";
    if($x == "A"){
        $rs = "<span>Direct</span>";
    }else if($x == "B"){
        $rs = "<span>Promptpay</span>";
    }else if($x == "C"){
        $rs = "<span>CreditCard</span>";
    }else if($x == "D"){
        $rs = "<span>TrueWallet</span>";
    }else{
        $rs = "";
    }
    return $rs;
}

function IsStatusPSBank($x){
    $rs="";
    if($x == "A"){
        $rs = "<span>รอรายการ</span>";
    }else if($x == "B"){
        $rs = "<span>รับคำสั่ง</span>";
    }else if($x == "C"){
        $rs = "<span>เสร็จสิ้น</span>";
    }else if($x == "D"){
        $rs = "<span>ยกเลิก</span>";
    }else{
        $rs = "";
    }
    return $rs;
}

function psBankRequestType($x){
    $rs="";
    if($x == "A"){
        $rs = "บุคคล";
    }else if($x == "B"){
        $rs = "บริษัท";
    }else{
        $rs = "";
    }
    return $rs;
}

function findBankDataById($bankData, $id) {
    foreach ($bankData as $bank) {
        if ($bank['Id'] == $id) {
            return $bank['BankCode'] . " , " . $bank['BankAccNo'] . " - " . $bank['BankAccName'];
        }
    }
    return null; // ถ้าไม่เจอข้อมูลที่ตรงกับ Id จะคืนค่า null
}


function GatewayStatusType($x){
    $rs="";
    if($x == "Y"){
        $rs = "Payment Gateway";
    }else if($x == "N"){
        $rs = "ไม่ใช่ Payment Gateway";
    }else{
        $rs = "";
    }
    return $rs;
}

function colorActionCallback($x){

    $rs = ""; // ค่าเริ่มต้นของผลลัพธ์

    switch($x) {
        case "Order.Success":
            $rs = "<span style='color: #28A745;'>$x</span>";
            break;
        case "Order.Amount":
            $rs = "<span style='color: #FFC107;'>$x</span>";
            break;
        case "Order.Choice":
            $rs = "<span style='color: #17A2B8;'>$x</span>";
            break;
        case "Order.Create":
            $rs = "<span style='color: #6610F2;'>$x</span>";
            break;
        case "Order.Cancel":
            $rs = "<span style='color: #FF4500;'>$x</span>";
            break;
        case "Withdraw.Create":
            $rs = "<span style='color: #9370DB;'>$x</span>";
            break;
        case "Withdraw.Start":
            $rs = "<span style='color: #87CEFA;'>$x</span>";
            break;
        case "Withdraw.Status":
            $rs = "<span style='color: #FFA500;'>$x</span>";
            break;
        case "Withdraw.Cancel":
            $rs = "<span style='color: #FF4500;'>$x</span>";
            break;
        case "Withdraw.Success":
            $rs = "<span style='color: #3CB371;'>$x</span>";
            break;
        default:
            $rs = ""; // กรณีที่ไม่ตรงเงื่อนไขใด ๆ
            break;
    }

    return $rs; // ส่งผลลัพธ์กลับไป
}

function generateSelectAction() {
    // กำหนดค่าต่าง ๆ และสีที่ตรงกับแต่ละค่า
    $options = [
        "Order.Success" => "#28A745",
        "Order.Amount" => "#FFC107",
        "Order.Choice" => "#17A2B8",
        "Order.Create" => "#6610F2",
        "Order.Cancel" => "#FF4500",
        "Withdraw.Create" => "#9370DB",
        "Withdraw.Start" => "#87CEFA",
        "Withdraw.Status" => "#FFA500",
        "Withdraw.Cancel" => "#FF4500",
        "Withdraw.Success" => "#3CB371"
    ];

    // เริ่มต้นตัวแปรที่จะเก็บผลลัพธ์
//    $html = "<select>\n";

    // วนลูปผ่านค่าทั้งหมดเพื่อนำไปสร้างเป็น option
    foreach ($options as $value => $color) {
        $html .= "<option style='color: $color;' data-color='$color' value='$value'>- $value</option>\n";
    }

    // ปิดแท็ก select
//    $html .= "</select>";

    return $html;
}


?>
