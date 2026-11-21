<?php
session_start();
include 'koneksi.php';

$nomor_induk = $_POST['nomor_induk'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE nomor_induk='$nomor_induk' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    $_SESSION['nomor_induk'] = $data['nomor_induk'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];
    
    if($data['role'] == "admin_pusat"){
        header("location:admin_dashboard.php");
    } else if($data['role'] == "guru_bk"){
        header("location:guru_dashboard.php");
    } else if($data['role'] == "siswa"){
        header("location:siswa_dashboard.php");
    }
} else {
    echo "<script>alert('Login Gagal! Nomor Induk atau Password salah.'); window.location='index.php';</script>";
}
?>