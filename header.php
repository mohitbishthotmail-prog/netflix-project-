<?php
ob_start();
session_start();
($_SESSION);

if (!isset($_SESSION['loged']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit; // Stop further execution
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Netflix India</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/style/style.css" rel="stylesheet">	
  <style>

</style>

</head>
<body class="page">
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="assets/images/logo.png" alt="Logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav gap-3 mx-auto">
        <li class="nav-item"><a class="nav-link" href="tv.php">TV Shows</a></li>
        <li class="nav-item"><a class="nav-link" href="movies.php">Movies</a></li>
        <li class="nav-item"><a class="nav-link" href="tmovies.php">Trending Movies</a></li>
      </ul>

		<div class="d-flex justify-content-center mt-3 mt-lg-0">
    <?php if(!isset($_SESSION['loged'])) { ?>
        <a href="login.php" class="btn btn-custom">Login</a>
    <?php } else { ?>
        <a href="logout.php" class="btn btn-custom">Logout</a>
    <?php } ?>
  </div>

    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

