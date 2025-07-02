<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ianp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('<span style="color: black;">Connection failed: <strong>PLEASE IMPORT FIRST THE \'ianp_db.sql\' DATABASE ON THE XAMPP</strong><br>or<br>' . $conn->connect_error . '</span>');
}
?>
