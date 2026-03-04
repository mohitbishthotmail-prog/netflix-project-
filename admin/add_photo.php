<?php
session_start();
ob_start();
include('config.php');
include('sidebar.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $movie = mysqli_real_escape_string($conn, $_POST['movie']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    // make sure upload folder exists
    $path = "upload/" . basename($image);
    move_uploaded_file($tmp_name, $path);

    $sql = "INSERT INTO category (movie, category, image) VALUES ('$movie','$category', '$image')";
    $query = mysqli_query($conn, $sql) or die("Check the query: " . mysqli_error($conn));

    header("Location: view_photo.php");
    exit();
}
?>

<main class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
  <br><br>
  <div class="form-container card shadow-sm p-4 translucent-card">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-light mb-0">📸 Upload Movies Poster</h4>  
      </a>
    </div>

    <form method="POST" enctype="multipart/form-data">
      <!-- Title -->
      <div class="mb-3">
        <label for="title" class="form-label text-light">Movie</label>
        <input type="text" class="form-control translucent-input text-light border-0" 
               id="movie" name="movie" placeholder="Enter movie" required>
      </div>

      <!-- Category Select -->
      <div class="mb-3">
        <label for="name" class="form-label text-light">Select Category</label>
        <select class="form-select translucent-input text-light border-0" 
                id="name" name="category" required>
          <option value="TV Shows">TV Shows</option>
          <option value="Movies">Movies</option>
          <option value="Trending Movies">Trending Movies</option>
        </select>
      </div>

      <!-- File Upload -->
      <div class="mb-3">
        <label for="photo" class="form-label text-light">
          <i class="bi bi-camera-fill"></i> Upload Movie Poster
        </label>
        <input type="file" 
               class="form-control translucent-input text-light border-0" 
               id="photo" name="photo" accept="image/*" onchange="previewImage(event)" required>

        <!-- Image Preview -->
        <div class="text-center mt-3">
          <img id="preview" 
               class="preview-img d-none img-fluid rounded shadow" 
               alt="Image Preview" 
               style="max-height: 200px;">
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-gradient w-100">
        <i class="bi bi-upload"></i> Submit
      </button>
    </form>
  </div>
</main>

<?php include('footer.php') ?>



