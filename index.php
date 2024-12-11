<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fff0f5 0%, #ffe4e1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins';
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .card {
            box-shadow: 0 20px 40px rgba(167,9,122,0.2);
            border-radius: 40px;
            max-width: 400px;
            width: 100%;
            transition: all 0.5s ease;
            overflow: hidden;
            box-sizing: border-box;
        }
        .card:hover {
            transform: perspective(1000px) rotateX(-10deg);
            box-shadow: 0 30px 50px rgba(167,9,122,0.3);
        }
        .card-header {
            background: linear-gradient(to right, #a7097a, #8a0662);
            color: white;
            padding: 1.5rem;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            box-sizing: border-box;
            overflow: hidden;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            padding: 15px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background-color: #a7097a;
            border-color: #a7097a;
            margin-bottom: 15px;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            color: white;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: all 0.5s ease;
        }
        .btn:hover::before {
            left: 100%;
        }
        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(167,9,122,0.3);
            background-color: #8a0662;
            color: grey;
        }
        .btn i {
            font-size: 1.5rem;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1 class="mb-0">Pendaftaran Siswa</h1>
            </div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                <div class="w-100">
                    <a href="form.php" class="btn btn w-100 mb-3">
                        <i class="bi bi-person-plus"></i> Daftar Siswa Baru
                    </a>
                    <a href="daftar.php" class="btn btn w-100">
                        <i class="bi bi-list-ul"></i> Lihat Pendaftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
