<div class="navbar">
        <div class="logo">
            <<img src="public/component/logoHijau.png" alt="Logo" width="50" height="50">

            <h1>SIMPA-TI</h1>
        </div>
        <div class="menu">
            <a href="#home">Home</a>
            <a href="#prestasi">Prestasi</a>
            <a href="#leaderboard">Leaderboard</a>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center mb-4">Data Admin</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th>Foto Profil</th>
                </tr>
            </thead>
            <tbody>
                <?php

use app\cores\Session;
use app\cores\View;

                $admins = View::getData();

                foreach ($admins as $index => $admin) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . htmlspecialchars($admin['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($admin['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($admin['nip']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($admin['foto']) . "' alt='Foto Admin' class='img-thumbnail' width='50'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="text-center">
            <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">Tambah Admin</button>
        </div>

        <!-- Modal Tambah Admin -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Tambah Data Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action=<?php echo '/dashboard/admin/'.Session::get("user").'/admin-data/insert'?> method="POST" enctype="multipart/form-data" id="batchForm">
                            <div id="adminInputs">
                                <div class="admin-group border p-3 mb-3">
                                    <h6>Admin 1</h6>
                                    <div class="mb-3">
                                        <label for="name1" class="form-label">Nama Admin</label>
                                        <input type="text" class="form-control" id="name1" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email1" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email1" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip1" class="form-label">NIP</label>
                                        <input type="text" class="form-control" id="nip1" name="nip" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photo1" class="form-label">Foto Profil</label>
                                        <input type="file" class="form-control" id="photo1" name="photo" accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" id="addMore">Tambah Admin Lagi</button>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('addMore').addEventListener('click', function() {
            const adminInputs = document.getElementById('adminInputs');
            const adminCount = adminInputs.children.length + 1;

            const newGroup = document.createElement('div');
            newGroup.classList.add('admin-group', 'border', 'p-3', 'mb-3');
            newGroup.innerHTML = `
                <h6>Admin ${adminCount}</h6>
                <div class="mb-3">
                    <label for="name${adminCount}" class="form-label">Nama Admin</label>
                    <input type="text" class="form-control" id="name${adminCount}" name="name[]" required>
                </div>
                <div class="mb-3">
                    <label for="email${adminCount}" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email${adminCount}" name="email[]" required>
                </div>
                <div class="mb-3">
                    <label for="nip${adminCount}" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip${adminCount}" name="nip[]" required>
                </div>
                <div class="mb-3">
                    <label for="photo${adminCount}" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" id="photo${adminCount}" name="photo[]" accept="image/*" required>
                </div>
            `;
            adminInputs.appendChild(newGroup);
        });
    </script>

</body>
<style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(180deg, #0039C8 0%, #001C62 100%);
            font-family: Poppins, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .container {
            width: 90%;
            max-width: 900px;
            background: white;
            border-radius: 30px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            padding: 20px;
            margin-top: 80px; /* To avoid overlap with navbar */
        }

        .header {
            text-align: center;
            margin: 20px 0;
        }

        .header h1 {
            font-size: 2rem;
            color: #0000EE;
        }

        .table thead {
            background-color: #0039C8;
            color: white;
        }

        .table th,
        .table td {
            text-align: center;
            padding: 10px;
        }

        .btn-primary {
            background-color: #0039C8;
            border: none;
            padding: 12px;
            font-size: 1rem;
            border-radius: 30px;
            color: white;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #001C62;
        }

        .modal-content {
            border-radius: 20px;
        }

        .modal-body .form-control {
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .navbar .logo h1 {
                font-size: 1.2rem;
            }

            .navbar .menu a {
                font-size: 0.9rem;
                margin: 0 8px;
            }

            .container {
                width: 100%;
                padding: 15px;
            }

            .table th,
            .table td {
                font-size: 0.9rem;
            }

            .btn-primary {
                width: 100%;
                font-size: 0.9rem;
            }
        }
    </style>
