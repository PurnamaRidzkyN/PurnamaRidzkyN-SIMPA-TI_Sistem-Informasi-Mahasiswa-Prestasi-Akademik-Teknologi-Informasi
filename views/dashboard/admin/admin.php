<?php use app\cores\Session;
$user = Session::get('user');
?>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#">Beranda</a>
        <a href="#">Profil</a>
        <a href="<?php echo '/dashboard/admin/' . $user . '/prestasi'; ?>">Prestasi</a>
        <a href="/logout">Logout</a>
    </div>
<h1>Dashboard admin</h1>
<a href="/change-password" class="btn btn-light btn-lg">rubah kata sandi</a>

<a href="<?php echo (Session::get("user"))?>/log-data" class="btn btn-light btn-lg">log data</a>
<a href="/logout">Logout</a>