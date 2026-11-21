<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "guru_bk"){
    header("location:index.php");
    exit;
}

// Proses konfirmasi jadwal oleh Guru BK
if(isset($_GET['setujui'])){
    $id = $_GET['setujui'];
    mysqli_query($koneksi, "UPDATE konseling SET status='Disetujui' WHERE id='$id'");
    header("location:jadwal_konseling.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Konseling - Guru BK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Daftar Pengajuan & Jadwal Konseling Siswa</h4>
            <a href="guru_dashboard.php" class="btn btn-light border btn-sm">Kembali ke Dashboard</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nama Siswa</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Topik & Keterangan</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT konseling.*, users.nama FROM konseling JOIN users ON konseling.nomor_induk = users.nomor_induk ORDER BY konseling.id DESC");
                        if(mysqli_num_rows($query) == 0){
                            echo "<tr><td colspan='5' class='text-center py-4 text-muted'>Belum ada pengajuan konseling dari siswa.</td></tr>";
                        }
                        while($data = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="px-4 py-3 fw-bold"><?php echo $data['nama']; ?></td>
                            <td class="py-3"><?php echo $data['tanggal_konseling']; ?></td>
                            <td class="py-3">
                                <strong><?php echo $data['topik']; ?></strong><br>
                                <small class="text-muted"><?php echo $data['keterangan']; ?></small>
                            </td>
                            <td class="py-3">
                                <?php if($data['status'] == "Disetujui"){ ?>
                                    <span class="badge bg-success">Disetujui</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                <?php } ?>
                            </td>
                            <td class="py-3">
                                <?php if($data['status'] != "Disetujui"){ ?>
                                    <a href="jadwal_konseling.php?setujui=<?php echo $data['id']; ?>" class="btn btn-success btn-sm">Setujui Jadwal</a>
                                <?php } else { ?>
                                    <span class="text-muted small">Selesai</span>
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