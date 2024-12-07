<?php use app\cores\Session;?>

<h1>Dashboard admin</h1>
<a href="/change-password" class="btn btn-light btn-lg">rubah kata sandi</a>

<a href="<?php echo (Session::get("user"))?>/log-data" class="btn btn-light btn-lg">log data</a>
<a href="/logout">Logout</a>