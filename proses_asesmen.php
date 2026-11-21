  <?php
session_start();
include 'koneksi.php';

$nomor_induk      = $_SESSION['nomor_induk'];
$hambatan_belajar = $_POST['hambatan_belajar'];
$catatan          = $_POST['catatan'];

mysqli_query($koneksi, "INSERT INTO asesmen (nomor_induk, hambatan_belajar, catatan) VALUES ('$nomor_induk', '$hambatan_belajar', '$catatan')");

header("location:siswa_dashboard.php?pesan=sukses");
?>