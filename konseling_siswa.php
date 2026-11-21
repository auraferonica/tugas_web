<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "siswa"){
    header("location:index.php");
    exit;
}

$nomor_induk = $_SESSION['nomor_induk'];

// Proses simpan pengajuan jadwal konseling
if(isset($_POST['ajukan'])){
    $topik      = $_POST['topik'];
    $tanggal    = $_POST['tanggal_konseling'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO konseling (nomor_induk, topik, tanggal_konseling, keterangan) VALUES ('$nomor_induk', '$topik', '$tanggal', '$keterangan')");
    header("location:konseling_siswa.php?pesan=terkirim");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konseling Siswa - SMK NEGERI 1 KRUI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 750px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-dark mb-0"><i class="bi bi-chat-dots me-2 text-primary"></i>Layanan Konseling Siswa</h4>
            <a href="siswa_dashboard.php" class="btn btn-light border btn-sm">Kembali ke Dashboard</a>
        </div>

        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == "terkirim"){ ?>
            <div class="alert alert-success">Pengajuan jadwal konseling berhasil dikirim ke Guru BK!</div>
        <?php } ?>

        <!-- Form Pengajuan -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h6 class="mb-0">Ajukan Jadwal Konseling Baru</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Topik / Bidang Konseling</label>
                            <select name="topik" class="form-select" required>
                                <option value="Bimbingan Belajar">Bimbingan Belajar</option>
                                <option value="Masalah Pribadi">Masalah Pribadi</option>
                                <option value="Hubungan Sosial / Teman">Hubungan Sosial / Teman</option>
                                <option value="Perencanaan Karir / Lanjut Kuliah">Perencanaan Karir / Lanjut Kuliah</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal yang Diinginkan</label>
                            <input type="date" name="tanggal_konseling" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ceritakan Singkat Keperluanmu</label>
                        <textarea name="keterangan" class="form-control" rows="3" required placeholder="Tuliskan hal yang ingin dikonsultasikan..."></textarea>
                    </div>
                    <button type="submit" name="ajukan" class="btn btn-primary w-100">Kirim Pengajuan Konseling</button>
                </form>
            </div>
        </div>

        <!-- Riwayat Pengajuan Siswa -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold text-dark">Riwayat Pengajuan Konselingmu</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="py-3">Topik</th>
                            <th class="py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $riwayat = mysqli_query($koneksi, "SELECT * FROM konseling WHERE nomor_induk='$nomor_induk' ORDER BY id DESC");
                        if(mysqli_num_rows($riwayat) == 0){
                            echo "<tr><td colspan='3' class='text-center py-4 text-muted'>Belum ada pengajuan konseling.</td></tr>";
                        }
                        while($row = mysqli_fetch_array($riwayat)){
                        ?>
                        <tr>
                            <td class="px-4 py-3"><?php echo $row['tanggal_konseling']; ?></td>
                            <td class="py-3">
                                <strong><?php echo $row['topik']; ?></strong><br>
                                <small class="text-muted"><?php echo $row['keterangan']; ?></small>
                            </td>
                            <td class="py-3">
                                <?php if($row['status'] == "Disetujui"){ ?>
                                    <span class="badge bg-success">Disetujui Guru BK</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning text-dark"><?php echo $row['status']; ?></span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>