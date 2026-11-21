<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "admin_pusat"){ 
    header("location:index.php"); 
    exit; 
}

// Proses simpan perubahan ke database saat tombol diklik
if(isset($_POST['simpan'])){
    $nama_aplikasi  = mysqli_real_escape_string($koneksi, $_POST['nama_aplikasi']);
    $nama_sekolah   = mysqli_real_escape_string($koneksi, $_POST['nama_sekolah']);
    $alamat_sekolah = mysqli_real_escape_string($koneksi, $_POST['alamat_sekolah']);

    mysqli_query($koneksi, "UPDATE branding SET 
        nama_aplikasi='$nama_aplikasi', 
        nama_sekolah='$nama_sekolah', 
        alamat_sekolah='$alamat_sekolah' 
        WHERE id=1");
    
    $pesan_sukses = true;
}

// Ambil data branding terbaru dari database
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM branding WHERE id=1"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Branding Sekolah - Admin Sekolah</title>
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
                <li class="nav-item"><a href="admin_laporan.php" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Laporan</a></li>
                <li class="nav-item"><a href="admin_branding.php" class="nav-link active"><i class="bi bi-gear me-2"></i> Branding</a></li>
            </ul>
            <div class="p-4 mt-5"><a href="logout.php" class="btn btn-outline-danger w-100">Logout</a></div>
        </div>
        <div class="flex-grow-1 p-5">
            <h3 class="fw-bold text-dark mb-1">Pengaturan Branding & Identitas Sekolah</h3>
            <p class="text-muted mb-4">Informasi instansi yang tampil pada portal layanan Bimbingan & Konseling.</p>
            
            <?php if(isset($pesan_sukses)){ ?>
                <div class="alert alert-success">Pengaturan branding sekolah berhasil disimpan ke database!</div>
            <?php } ?>

            <div class="card shadow-sm border-0 p-4" style="max-width: 600px;">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Aplikasi</label>
                        <input type="text" name="nama_aplikasi" class="form-control" value="<?php echo htmlspecialchars($data['nama_aplikasi']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Instansi / Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control" value="<?php echo htmlspecialchars($data['nama_sekolah']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Sekolah</label>
                        <textarea name="alamat_sekolah" class="form-control" rows="2" required><?php echo htmlspecialchars($data['alamat_sekolah']); ?></textarea>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>