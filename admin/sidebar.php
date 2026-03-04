<?php include("config.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<nav class="sidebar p-3">
  <!-- Sidebar Title / Branding -->
  <h4 class="sidebar-title mb-4">
  <i class="bi bi-gear-fill me-2"></i>
  Admin
</h4>

  <!-- Navigation Menu -->
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link <?php echo ($currentPage == 'index2.php') ? 'active' : ''; ?>" href="index2.php">
        <i class="bi bi-house-door-fill me-2"></i>
        Home
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($currentPage == 'add_photo.php') ? 'active' : ''; ?>" href="add_photo.php">
        <i class="bi bi-image-fill me-2"></i>
        Add posters
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($currentPage == 'view_photo.php') ? 'active' : ''; ?>" href="view_photo.php">
        <i class="bi bi-collection-play-fill me-2"></i>
         Poster List
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($currentPage == 'movie_detail.php') ? 'active' : ''; ?>" href="movie_detail.php">
        <i class="bi bi-film me-2"></i>
        Add Movies
      </a>
    </li>
	 <li class="nav-item">
      <a class="nav-link <?php echo ($currentPage == 'view_movie.php') ? 'active' : ''; ?>" href="view_movie.php">
        <i class="bi bi-collection-play-fill me-2"></i>
         Movies List
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($currentPage == 'logout.php') ? 'active' : ''; ?>" href="logout.php">
        <i class="bi bi-box-arrow-right me-2"></i>
        Logout
      </a>
    </li>
  </ul>
</nav>

<body>