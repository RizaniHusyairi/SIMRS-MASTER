<?php
/*
 *      koneksi.php
 *      Melakukan koneksi ke database
 */
$user = "root";
$host = "localhost";
$pass = "";
$db = "db_rumahsakit";
$conn = mysqli_connect($host,$user,$pass,$db) or die("koneksi gagal");

?>
