<?php
// กำหนดการตั้งค่า Memcached server ##
ini_set('session.save_handler', 'memcached');
ini_set('session.save_path', '34.142.202.173:11211'); // แทนที่ด้วย IP และพอร์ตของ Memcached server ของคุณ

// เริ่มต้น Session
session_start();

// ทดสอบการตั้งค่า session
if (!isset($_SESSION['test_counter'])) {
    $_SESSION['test_counter'] = 0;
} else {
    $_SESSION['test_counter']++;
}

// แสดงผลข้อมูล session และการเชื่อมต่อกับ Memcached
echo "<h2>Memcached Session Test</h2>";
echo "Session ID: " . session_id() . "<br>";
echo "Session Save Path: " . ini_get('session.save_path') . "<br>";
echo "Session Handler: " . ini_get('session.save_handler') . "<br>";
echo "Counter Value: " . $_SESSION['test_counter'] . "<br>";

// ตรวจสอบการเชื่อมต่อกับ Memcached
$memcached = new Memcached();
$memcached->addServer('34.142.202.173', 11211); // แทนที่ด้วย IP และพอร์ตของ Memcached server ของคุณ

if ($memcached->getVersion() === false) {
    echo "<p style='color:red;'>Failed to connect to Memcached server.</p>";
} else {
    echo "<p style='color:green;'>Connected to Memcached server. Version: " . implode(", ", $memcached->getVersion()) . "</p>";
}

// เพิ่มการเก็บข้อมูลลงใน Memcached
$key = 'test_key';
$value = 'Hello Memcached!';
$memcached->set($key, $value);

// ดึงข้อมูลจาก Memcached เพื่อตรวจสอบว่าใช้งานได้
$retrievedValue = $memcached->get($key);
if ($retrievedValue === false) {
    echo "<p style='color:red;'>Failed to retrieve value from Memcached.</p>";
} else {
    echo "<p style='color:green;'>Successfully retrieved value from Memcached: " . $retrievedValue . "</p>";
}
?>
