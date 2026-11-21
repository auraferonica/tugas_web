<?php
session_start();
include 'koneksi.php'; // Memanggil koneksi database

// Cek sesi login
if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "admin_pusat"){
    header("location:index.php");
    exit;
}

// Hitung jumlah akun per role secara otomatis dari database
$jml_admin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE role='admin_pusat'"));
$jml_guru  = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE role='guru_bk'"));
$jml_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE role='siswa'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - SMK NEGERI 1 KRUI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background-color: #ffffff; border-right: 1px solid #e3e6f0; }
        .nav-link { color: #5a5c69; font-weight: 500; padding: 12px 20px; }
        .nav-link:hover, .nav-link.active { background-color: #f8f9fc; color: #4e73df; }
        .stat-card { background: white; border: none; border-radius: 10px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,0.1); }
        .text-gray-500 { color: #b7b9cc; font-size: 0.85rem; font-weight: bold; letter-spacing: 1px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Kiri -->
        <div class="sidebar" style="width: 250px;">
            <div class="p-4 text-primary fw-bold fs-4">MEGA</div>
            <ul class="nav flex-column mb-auto mt-2">
                <li class="nav-item"><a href="admin_dashboard.php" class="nav-link active"><i class="bi bi-people me-2"></i> Pengguna</a></li>
                <li class="nav-item"><a href="admin_kelas.php" class="nav-link"><i class="bi bi-journal-bookmark me-2"></i> Kelas</a></li>
                <li class="nav-item"><a href="admin_notifikasi.php" class="nav-link"><i class="bi bi-bell me-2"></i> Notifikasi</a></li>
                <li class="nav-item"><a href="admin_laporan.php" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Laporan</a></li>
                <li class="nav-item"><a href="admin_branding.php" class="nav-link"><i class="bi bi-gear me-2"></i> Branding</a></li>
            </ul>
            <div class="p-4 mt-5">
                <a href="logout.php" class="btn btn-outline-danger w-100">Logout</a>
            </div>
        </div>

        <!-- Konten Utama Kanan -->
        <div class="flex-grow-1 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">SMK NEGERI 1 KRUI</h3>
                    <p class="text-muted mb-0">Dashboard Admin Sekolah - Pantau pengguna, asesmen, dan evaluasi.</p>
                </div>
                <a href="tambah_pengguna.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Pengguna</a>
            </div>

            <!-- Kartu Statistik Dinamis -->
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="stat-card p-4 text-center">
                        <div class="text-gray-500 mb-2">ADMIN SEKOLAH</div>
                        <h3 class="fw-bold text-dark mb-0"><?php echo $jml_admin; ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-4 text-center">
                        <div class="text-gray-500 mb-2">GURU BK</div>
                        <h3 class="fw-bold text-dark mb-0"><?php echo $jml_guru; ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-4 text-center">
                        <div class="text-gray-500 mb-2">SISWA TERDAFTAR</div>
                        <h3 class="fw-bold text-dark mb-0"><?php echo $jml_siswa; ?></h3>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Pengguna -->
            <h6 class="text-gray-500 mb-3">DAFTAR PENGGUNA TERDAFTAR</h6>
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="py-3">Nomor Induk</th>
                                <th class="py-3">Nama Pengguna</th>
                                <th class="py-3">Role / Peran</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM users");
                            $no = 1;
                            while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td class="px-4 py-3"><?php echo $no++; ?></td>
                                <td class="py-3"><?php echo $data['nomor_induk']; ?></td>
                                <td class="py-3 fw-bold"><?php echo $data['nama']; ?></td>
                                <td class="py-3">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2 rounded-pill">
                                        <?php echo $data['role']; ?>
                                    </span>
                                </td>
                                <td class="py-3">
                                    <button class="btn btn-sm btn-light border">Edit</button>
                                    <button class="btn btn-sm btn-light border text-danger">Hapus</button>
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