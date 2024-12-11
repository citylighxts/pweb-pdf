<?php
include 'database.php';

$query_pegawai = "SELECT * FROM pegawai";
$result_pegawai = mysqli_query($koneksi, $query_pegawai);

$id = $_GET['id'];
$query_siswa = "SELECT * FROM siswa WHERE id_siswa = $id";
$result_siswa = mysqli_query($koneksi, $query_siswa);
$siswa = mysqli_fetch_assoc($result_siswa);

if(isset($_POST['submit'])) {
    $nama = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $id_pegawai = $_POST['id_pegawai'];

    $query = "UPDATE siswa SET nama_siswa='$nama', jenis_kelamin='$jenis_kelamin', 
              email='$email', id_pegawai='$id_pegawai' 
              WHERE id_siswa = $id";
    
    mysqli_query($koneksi, $query);
    header("Location: daftar.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Poppins';
        }
        .card-header {
            background: linear-gradient(to right, #a7097a, #8a0662) !important;
            color: white;
        }
        .btn {
            background-color: #a7097a !important;
            color: white !important;
        }
        .btn:hover {
            color: black !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-white d-flex align-items-center">
                <i class="bi bi-pencil-square me-3 fs-4"></i>
                <h2 class="mb-0">Edit Data Siswa</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">ID Siswa</label>
                                <input type="text" class="form-control" value="<?= $siswa['id_siswa'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama_siswa" value="<?= $siswa['nama_siswa'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin">
                                    <option value="L" <?= $siswa['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= $siswa['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $siswa['email'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pegawai yang Menangani</label>
                                <select class="form-select" name="id_pegawai">
                                    <?php 
                                    mysqli_data_seek($result_pegawai, 0); // Reset pointer
                                    while($pegawai = mysqli_fetch_assoc($result_pegawai)) { ?>
                                        <option value="<?= $pegawai['id_pegawai'] ?>" 
                                            <?= $pegawai['id_pegawai'] == $siswa['id_pegawai'] ? 'selected' : '' ?>>
                                            <?= $pegawai['nama'] ?> - <?= $pegawai['jabatan'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="daftar.php" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" name="submit" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Update Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
