<?php
// Asumsikan data mahasiswa sudah tersedia dalam variabel $mahasiswa

use app\cores\Session;
use app\cores\View;

$mahasiswa = View::getData()["result"];
?>

	
	<style>
		
        /* Custom style for Daftar Mahasiswa */
        .daftar-mahasiswa-title {
            font-size: 5vw;
            font-family: 'Roboto', sans-serif;
            font-style: italic;
            font-weight: 400;
            color: #0039C8;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            width: 20rem;
            margin: 10px;
            cursor: pointer;
        }

        .card-body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #0039C8;
        }

        .card-text {
            color: #555;
        }
	</style>

	

<div class="container mt-5">
    <h2 class="text-center mb-4 daftar-mahasiswa-title">Daftar Mahasiswa</h2>
    <div class="card-container">
    <?php foreach ($mahasiswa as $m): ?>
        <form action=<?php echo '/dashboard/admin/' . Session::get("user") . '/prestasi' ?> method="POST">
            <div class="card" style="cursor: pointer;" onclick="this.closest('form').submit()">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($m['nama']) ?></h5>
                    <p class="card-text"><strong>NIM:</strong> <?= htmlspecialchars($m['nim']) ?></p>
                    <p class="card-text"><strong>Prodi:</strong> <?= htmlspecialchars($m['prodi']) ?></p>
                    <p class="card-text"><strong>Total Skor:</strong> <?= htmlspecialchars($m['total_skor']) ?></p>
                    <input type="hidden" name="nim" value="<?= htmlspecialchars($m['nim']) ?>">
                </div>
            </div>
        </form>
    <?php endforeach; ?>
</div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
