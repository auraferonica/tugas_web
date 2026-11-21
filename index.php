<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem BK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow" style="width: 25rem;">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Login Sistem BK</h4>
            <p class="text-center text-muted small">Universitas XYZ <br> WA Pendamping: 0812-XXXX-XXXX</p>
            
            <form action="proses_login.php" method="POST">
                <div class="mb-3">
                    <label>Nomor Induk (NIS/NIP)</label>
                    <input type="text" name="nomor_induk" class="form-control" required placeholder="Masukkan NIS atau Admin01">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>