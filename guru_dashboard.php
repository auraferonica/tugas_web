<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "guru_bk"){
    header("location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Guru BK - SMK NEGERI 1 KRUI</title>
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
                <li class="nav-item"><a href="guru_dashboard.php" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i> Dashboard BK</a></li>
                <li class="nav-item"><a href="data_siswa.php" class="nav-link"><i class="bi bi-people me-2"></i> Data Siswa</a></li>
                <li class="nav-item"><a href="hasil_asesmen.php" class="nav-link"><i class="bi bi-clipboard-data me-2"></i> Hasil Asesmen</a></li>
                <li class="nav-item"><a href="jadwal_konseling.php" class="nav-link"><i class="bi bi-chat-left-text me-2"></i> Jadwal Konseling</a></li>
            </ul>
            <div class="p-4 mt-5">
                <a href="logout.php" class="btn btn-outline-danger w-100">Logout</a>
            </div>
        </div>

        <div class="flex-grow-1 p-5">
            <h3 class="fw-bold text-dark mb-1">Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h3>
            <p class="text-muted mb-4">Panel Layanan Bimbingan & Konseling - SMK Negeri 1 Krui.</p>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold text-primary">Daftar Siswa Binaan & Hasil Asesmen</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="py-3">NISN / Nomor Induk</th>
                                <th class="py-3">Nama Siswa</th>
                                <th class="py-3">Status Asesmen</th>
                                <th class="py-3">Hambatan & Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT users.*, asesmen.hambatan_belajar, asesmen.catatan 
                                                             FROM users 
                                                             LEFT JOIN asesmen ON users.nomor_induk = asesmen.nomor_induk 
                                                             WHERE users.role='siswa'");
                            $no = 1;
                            while($siswa = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td class="px-4 py-3"><?php echo $no++; ?></td>
                                <td class="py-3"><?php echo $siswa['nomor_induk']; ?></td>
                                <td class="py-3 fw-bold"><?php echo $siswa['nama']; ?></td>
                                <td class="py-3">
                                    <?php if($siswa['hambatan_belajar'] != ""){ ?>
                                        <span class="badge bg-success">Sudah Mengisi</span>
                                    <?php } else { ?>
                                        <span class="badge bg-warning text-dark">Belum Mengisi</span>
                                    <?php } ?>
                                </td>
                                <td class="py-3 small">
                                    <?php 
                                    if($siswa['hambatan_belajar'] != ""){
                                        echo "<strong>" . $siswa['hambatan_belajar'] . "</strong><br><span class='text-muted'>" . $siswa['catatan'] . "</span>";
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>