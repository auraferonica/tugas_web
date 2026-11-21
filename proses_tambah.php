<?php
include 'koneksi.php';

$nomor_induk = $_POST['nomor_induk'];
$nama        = $_POST['nama'];
$password    = $_POST['password']; 
$role        = $_POST['role'];

mysqli_query($koneksi, "INSERT INTO users (nomor_induk, nama, password, role) VALUES ('$nomor_induk', '$nama', '$password', '$role')");

header("location:admin_dashboard.php");
?>