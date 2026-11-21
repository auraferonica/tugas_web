<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "admin_pusat"){ header("location:index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Sistem - Admin Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background-color: #ffffff; border-right: 1px solid #e3e6f0; }
        .nav-link { color: #5a5c69; font-weight: 500; padding: 12px 20px; }
        .nav-link:hover, .nav-link.active { background-color: #f8f9fc; color: #4e73df; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar" style="width: 250px;">
            <div class="p-4 text-primary fw-bold fs-4">MEGA</div>
            <ul class="nav flex-column mb-auto mt-2">
                <li class="nav-item"><a href="admin_dashboard.php" class="nav-link"><i class="bi bi-people me-2"></i> Pengguna</a></li>
                <li class="nav-item"><a href="admin_kelas.php" class="nav-link"><i class="bi bi-journal-bookmark me-2"></i> Kelas</a></li>
                <li class="nav-item"><a href="admin_notifikasi.php" class="nav-link active"><i class="bi bi-bell me-2"></i> Notifikasi</a></li>
                <li class="nav-item"><a href="admin_laporan.php" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Laporan</a></li>
                <li class="nav-item"><a href="admin_branding.php" class="nav-link"><i class="bi bi-gear me-2"></i> Branding</a></li>
            </ul>
            <div class="p-4 mt-5"><a href="logout.php" class="btn btn-outline-danger w-100">Logout</a></div>
        </div>
        <div class="flex-grow-1 p-5">
            <h3 class="fw-bold text-dark mb-1">Notifikasi Aktivitas Layanan BK</h3>
            <p class="text-muted mb-4">Pemantauan otomatis aktivitas asesmen dan pengajuan konseling siswa.</p>
            <div class="card shadow-sm border-0 p-4">
                <?php
                $asesmen = mysqli_query($koneksi, "SELECT asesmen.*, users.nama FROM asesmen JOIN users ON asesmen.nomor_induk = users.nomor_induk ORDER BY asesmen.id DESC");
                while($a = mysqli_fetch_array($asesmen)){
                    echo "<div class='alert alert-info mb-2'><i class='bi bi-clipboard-check me-2'></i><strong>".$a['nama']."</strong> baru saja mengisi Asesmen BK (".$a['hambatan_belajar'].").</div>";
                }
                $konseling = mysqli_query($koneksi, "SELECT konseling.*, users.nama FROM konseling JOIN users ON konseling.nomor_induk = users.nomor_induk ORDER BY konseling.id DESC");
                while($k = mysqli_fetch_array($konseling)){
                    echo "<div class='alert alert-warning mb-2'><i class='bi bi-chat-dots me-2'></i><strong>".$k['nama']."</strong> mengajukan jadwal konseling topik <strong>".$k['topik']."</strong> (Status: ".$k['status'].").</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>