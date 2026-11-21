<?php
session_start();
if(!isset($_SESSION['nomor_induk'])){ header("location:index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 500px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white p-3">
                <h5 class="mb-0">Tambah Akun Pengguna</h5>
            </div>
            <div class="card-body p-4">
                <form action="proses_tambah.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold">Nomor Induk (Username)</label>
                        <input type="text" name="nomor_induk" class="form-control" required placeholder="Masukkan NIK/NISN">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Nama Lengkap">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Buat Password">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted fw-bold">Role / Peran</label>
                        <select name="role" class="form-select" required>
                            <option value="admin_pusat">Admin Pusat</option>
                            <option value="guru_bk">Guru BK</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Simpan Data</button>
                    <a href="admin_dashboard.php" class="btn btn-light w-100 border">Batal & Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>