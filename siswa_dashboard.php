<?php
session_start();
if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "siswa"){
    header("location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa - SMK NEGERI 1 KRUI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background-color: #ffffff; border-right: 1px solid #e3e6f0; }
        .nav-link { color: #5a5c69; font-weight: 500; padding: 12px 20px; }
        .nav-link:hover, .nav-link.active { background-color: #f8f9fc; color: #4e73df; }
        .card-menu { background: white; border: none; border-radius: 10px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,0.1); }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar" style="width: 250px;">
            <div class="p-4 text-primary fw-bold fs-4">MEGA</div>
            <ul class="nav flex-column mb-auto mt-2">
                <li class="nav-item"><a href="siswa_dashboard.php" class="nav-link active"><i class="bi bi-house-door me-2"></i> Beranda</a></li>
                <li class="nav-item"><a href="asesmen_siswa.php" class="nav-link"><i class="bi bi-clipboard-check me-2"></i> Asesmen BK</a></li>
                <li class="nav-item"><a href="rencana_belajar.php" class="nav-link"><i class="bi bi-journal-text me-2"></i> Rencana Belajarku</a></li>
                <li class="nav-item"><a href="konseling_siswa.php" class="nav-link"><i class="bi bi-chat-dots me-2"></i> Konseling</a></li>
            </ul>
            <div class="p-4 mt-5">
                <a href="logout.php" class="btn btn-outline-danger w-100">Logout</a>
            </div>
        </div>

        <div class="flex-grow-1 p-5">
            <h3 class="fw-bold text-dark mb-1">Halo, <?php echo $_SESSION['nama']; ?>!</h3>
            <p class="text-muted mb-4">Selamat datang di Layanan Bimbingan & Konseling SMK Negeri 1 Krui.</p>

            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == "sukses"){ ?>
                <div class="alert alert-success">Terima kasih! Hasil asesmenmu sudah terkirim ke Guru BK.</div>
            <?php } ?>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card-menu p-4">
                        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-clipboard-check me-2"></i>Asesmen Kebutuhan Siswa</h5>
                        <p class="text-muted small mb-3">Isi kuesioner singkat untuk membantu Guru BK memahami kebutuhan dan hambatan belajarmu.</p>
                        <a href="asesmen_siswa.php" class="btn btn-primary btn-sm">Mulai Asesmen</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-menu p-4">
                        <h5 class="fw-bold text-success mb-2"><i class="bi bi-journal-text me-2"></i>Latihan Rencana Belajar</h5>
                        <p class="text-muted small mb-3">Kesulitan memulai tugas? Ikuti panduan interaktif untuk menyusun target belajarmu hari ini.</p>
                        <a href="rencana_belajar.php" class="btn btn-success btn-sm">Buka Latihan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>