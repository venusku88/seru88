<?php
$host = 'localhost';
$user = 'dudukdisininak_discoveryseru';
$pass = 'Discoveryseru00123!'; // ganti dengan password MySQL kamu
$dbname = 'dudukdisininak_discoveryseru';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
