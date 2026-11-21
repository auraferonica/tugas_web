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
    <title>Asesmen Kebutuhan Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white p-3">
                <h5 class="mb-0">Asesmen Kebutuhan Belajar Siswa</h5>
            </div>
            <div class="card-body p-4">
                <form action="proses_asesmen.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Apa hambatan belajar utama yang kamu rasakan saat ini?</label>
                        <select name="hambatan_belajar" class="form-select" required>
                            <option value="">-- Pilih Hambatan --</option>
                            <option value="Sulit mengatur waktu belajar">Sulit mengatur waktu belajar</option>
                            <option value="Kurang fokus / mudah terdistraksi HP">Kurang fokus / mudah terdistraksi HP</option>
                            <option value="Kesulitan memahami materi pelajaran">Kesulitan memahami materi pelajaran</option>
                            <option value="Cemas / kurang percaya diri saat ujian">Cemas / kurang percaya diri saat ujian</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Ceritakan singkat atau harapanmu kepada Guru BK:</label>
                        <textarea name="catatan" class="form-control" rows="4" required placeholder="Tuliskan keluhan atau target belajarmu..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Kirim Hasil Asesmen</button>
                    <a href="siswa_dashboard.php" class="btn btn-light w-100 border">Kembali ke Dashboard</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>