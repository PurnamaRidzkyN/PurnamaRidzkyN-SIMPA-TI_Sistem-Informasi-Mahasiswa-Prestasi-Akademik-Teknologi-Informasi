<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Galatea', sans-serif;
            background-color: #f5f5f5;
        }

        .big-banner {
            height: 40vh;
            background: linear-gradient(270deg, #0039C8 0%, #001C62 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            position: relative;
            padding: 20px;
        }

        .leaderboard-title {
            font-size: 6vw;
            font-family: 'Robot Crush', sans-serif;
            font-style: italic;
            font-weight: 400;
            color: #AFFA08;
            max-width: 100%;
            word-wrap: break-word;  /* Ensure text wraps within the container */
        }

        .banner-caption {
            font-size: 4vw;
            font-family: 'Galatea', sans-serif;
            font-weight: 700;
            color: white;
            max-width: 100%;
            word-wrap: break-word;  /* Ensure text wraps within the container */
        }

        /* Section Styles */
        .section {
            background-color: #0039C8;
            padding: 20px;
            border-radius: 15px;
            margin: 15px;
            max-width: 100%;
            word-wrap: break-word;  /* Ensure text wraps within the container */
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            text-align: center;
            margin-bottom: 15px;
        }

        .btn-warning {
            background-color: #AFFA08;
            color: #0039C8;
            border: none;
        }

        .btn-warning:hover {
            background-color: white;
            color: #0039C8;
        }

        .btn-success {
            background-color: #AFFA08;
            color: #0039C8;
            border: none;
        }

        .btn-success:hover {
            background-color: #0039C8;
        }

        .upload-btn {
            font-family: 'Robot Crush', sans-serif;
            font-size: 40px;
            font-weight: 300;
            background-color: #0039C8;
            color: #AFFA08;
            border: none;
            padding: 20px;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            max width: 100%;
        }

        /* Container Responsif */
        .container {
            max-width: 100%;
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Flexbox untuk data container */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 5px; /* Mengurangi gap untuk tombol lebih rapat */
        }
    </style>
</head>
<body>

    <!-- Big Banner -->
    <div class="big-banner">
        <h2 class="leaderboard-title">PRESTASI MAHASISWA</h2>
        <p class="banner-caption">Data Kompetisi Mahasiswa</p>
    </div>

    <!-- Form Section -->
    <div class="section section-short">
        <div class="section-title">Form Prestasi Mahasiswa</div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="PrestasiForm.html" class="btn btn-warning">Isi Form Prestasi</a>
            </div>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="section">
        <div class="section-title">Status Validasi</div>
        <div class="row justify-content-center">
            <div class="col-md-5 text-center">
                <button class="btn btn-warning w-100" id="filterBelum">Belum Divalidasi</button>
            </div>
            <div class="col-md-5 text-center">
                <button class="btn btn-success w-100" id="filterSudah">Sudah Divalidasi</button>
            </div>
        </div>
    </div>

    <!-- Data Container -->
    <div class="container">
        <div id="belum-div" class="row">
            <!-- Data "Belum Divalidasi" akan ditampilkan di sini -->
        </div>
        <div id="sudah-div" class="row">
            <!-- Data "Sudah Divalidasi" akan ditampilkan di sini -->
        </div>
    </div>

    <!-- JS and Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
