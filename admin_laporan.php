<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "admin_pusat"){ header("location:index.php"); exit; }

$jml_siswa     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE role='siswa'"));
$jml_guru      = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE role='guru_bk'"));
$jml_asesmen   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM asesmen"));
$jml_konseling = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM konseling"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan BK - Admin Sekolah</title>
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
                <li class="nav-item"><a href="admin_notifikasi.php" class="nav-link"><i class="bi bi-bell me-2"></i> Notifikasi</a></li>
                <li class="nav-item"><a href="admin_laporan.php" class="nav-link active"><i class="bi bi-bar-chart me-2"></i> Laporan</a></li>
                <li class="nav-item"><a href="admin_branding.php" class="nav-link"><i class="bi bi-gear me-2"></i> Branding</a></li>
            </ul>
            <div class="p-4 mt-5"><a href="logout.php" class="btn btn-outline-danger w-100">Logout</a></div>
        </div>
        <div class="flex-grow-1 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Laporan Evaluasi Layanan BK</h3>
                    <p class="text-muted mb-0">Rekapitulasi data real-time SMK Negeri 1 Krui.</p>
                </div>
                <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer me-2"></i>Cetak Laporan</button>
            </div>
            <div class="row g-4">
                <div class="col-md-3"><div class="card border-0 shadow-sm p-4 text-center"><small class="text-muted fw-bold">TOTAL SISWA</small><h2 class="fw-bold text-primary mt-2"><?php echo $jml_siswa; ?></h2></div></div>
                <div class="col-md-3"><div class="card border-0 shadow-sm p-4 text-center"><small class="text-muted fw-bold">GURU BK</small><h2 class="fw-bold text-success mt-2"><?php echo $jml_guru; ?></h2></div></div>
                <div class="col-md-3"><div class="card border-0 shadow-sm p-4 text-center"><small class="text-muted fw-bold">ASESMEN MASUK</small><h2 class="fw-bold text-info mt-2"><?php echo $jml_asesmen; ?></h2></div></div>
                <div class="col-md-3"><div class="card border-0 shadow-sm p-4 text-center"><small class="text-muted fw-bold">SESI KONSELING</small><h2 class="fw-bold text-warning mt-2"><?php echo $jml_konseling; ?></h2></div></div>
            </div>
        </div>
    </div>
</body>
</html>