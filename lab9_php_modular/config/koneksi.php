<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "latihan1";
$port = 3307;
$conn = mysqli_connect($host, $user, $pass, $db, $port);
if ($conn == false)
{
echo "Koneksi ke server gagal.";
die();
} #else echo "Koneksi berhasil";

$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);

?>

