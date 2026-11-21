<?php
session_start();
if(!isset($_SESSION['nomor_induk']) || $_SESSION['role'] != "siswa"){
    header("location:index.php");
    exit;
}

// Logika sederhana untuk memberikan rekomendasi strategi belajar berdasarkan pilihan siswa
$rekomendasi = "";
$langkah = [];
if(isset($_POST['proses'])){
    $kondisi = $_POST['kondisi'];
    $target  = htmlspecialchars($_POST['target']);
    
    if($kondisi == "bingung"){
        $rekomendasi = "Metode Pecah Tugas (Chunking)";
        $langkah = [
            "Jangan langsung memikirkan selesainya tugas <strong>'$target'</strong>, fokus pada 10 menit pertama saja.",
            "Tulis 3 poin paling dasar yang harus dikerjakan terlebih dahulu di kertas.",
            "Kerjakan poin pertama tanpa melihat HP selama 15 menit."
        ];
    } elseif($kondisi == "malas"){
        $rekomendasi = "Teknik Pomodoro (25 Menit Fokus + 5 Menit Istirahat)";
        $langkah = [
            "Jauhkan HP atau aktifkan mode senyap selama 25 menit ke depan.",
            "Mulai kerjakan <strong>'$target'</strong> secara perlahan hingga alarm 25 menit berbunyi.",
            "Ambil waktu istirahat 5 menit untuk minum atau peregangan sebelum lanjut sesi berikutnya."
        ];
    } else {
        $rekomendasi = "Strategi Prioritas & Catatan Ringkas";
        $langkah = [
            "Baca ulang ringkasan materi terkait <strong>'$target'</strong> selama 10 menit.",
            "Tandai bagian yang belum dipahami untuk ditanyakan ke teman atau Guru BK.",
            "Kerjakan soal/tugas yang paling mudah terlebih dahulu untuk membangun rasa percaya diri."
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Rencana Belajar - SMK NEGERI 1 KRUI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 650px;">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-success text-white p-3">
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Latihan Rencana Belajar Harian</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Apa target tugas atau pelajaran yang ingin kamu selesaikan hari ini?</label>
                        <input type="text" name="target" class="form-control" required placeholder="Contoh: Mengerjakan tugas Matematika Bab 2" value="<?php echo isset($_POST['target']) ? htmlspecialchars($_POST['target']) : ''; ?>">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Apa kendala utama yang membuatmu sulit memulainya sekarang?</label>
                        <select name="kondisi" class="form-select" required>
                            <option value="bingung">Bingung harus mulai dari mana (tugas terasa menumpuk)</option>
                            <option value="malas">Sulit fokus, mengantuk, atau tergoda membuka HP</option>
                            <option value="sulit">Merasa materinya terlalu sulit dipahami</option>
                        </select>
                    </div>
                    <button type="submit" name="proses" class="btn btn-success w-100 mb-2">Susun Strategi Belajarku</button>
                    <a href="siswa_dashboard.php" class="btn btn-light w-100 border">Kembali ke Dashboard</a>
                </form>
            </div>
        </div>

        <?php if($rekomendasi != ""){ ?>
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <span class="badge bg-success mb-2">Rekomendasi Strategi BK</span>
                <h5 class="fw-bold text-dark mb-3"><?php echo $rekomendasi; ?></h5>
                <ol class="mb-0 ps-3">
                    <?php foreach($langkah as $step){ ?>
                        <li class="mb-2"><?php echo $step; ?></li>
                    <?php } ?>
                </ol>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>