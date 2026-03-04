<?php
session_start();
ob_start();
include('config.php');
include('sidebar.php');

// 1) Get record by ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM category WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Record not found!");
    }
} else {
    die("Invalid request!");
}

// 2) Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $movie = mysqli_real_escape_string($conn, $_POST['movie']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    if (!empty($image)) {
        // New image uploaded
        $path = "upload/" . basename($image);
        move_uploaded_file($tmp_name, $path);
    } else {
        // Keep old image
        $image = $row['image'];
    }

    $update_sql = "UPDATE category 
                   SET movie = '$movie', category = '$category', image = '$image' 
                   WHERE id = $id";
    $query = mysqli_query($conn, $update_sql) or die("Check the query: " . mysqli_error($conn));

    header("Location: view_photo.php");
    exit();
}
?>

<main class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
  <br><br>
  <div class="form-container card shadow-sm p-4 translucent-card">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-light mb-0">✏️ Update Photo</h4>  
    </div>

    <form method="POST" enctype="multipart/form-data">
      <!-- Movie Title -->
      <div class="mb-3">
        <label for="movie" class="form-label text-light">Movie</label>
        <input type="text" 
               class="form-control translucent-input text-light border-0" 
               id="movie" 
               name="movie" 
               value="<?php echo htmlspecialchars($row['movie']); ?>" 
               required>
      </div>

      <!-- Category Select -->
      <div class="mb-3">
        <label for="name" class="form-label text-light">Select Category</label>
        <select class="form-select translucent-input text-light border-0" 
                id="name" name="category" required>
          <option value="TV Shows" <?php if ($row['category'] == "TV Shows") echo "selected"; ?>>TV Shows</option>
          <option value="Movies" <?php if ($row['category'] == "Movies") echo "selected"; ?>>Movies</option>
          <option value="Trending Movies" <?php if ($row['category'] == "Trending Movies") echo "selected"; ?>>Trending Movies</option>
        </select>
      </div>

      <!-- File Upload -->
      <div class="mb-3">
        <label for="photo" class="form-label text-light">
          <i class="bi bi-camera-fill"></i> Change Photo
        </label>
        <input type="file" 
               class="form-control translucent-input text-light border-0" 
               id="photo" name="photo" accept="image/*" onchange="previewImage(event)">

        <!-- Current Image Preview -->
        <div class="text-center mt-3">
          <img src="upload/<?php echo $row['image']; ?>" 
               id="preview" 
               class="preview-img img-fluid rounded shadow" 
               alt="Current Image" 
               style="max-height: 200px;">
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-gradient w-100">
        <i class="bi bi-check2-circle"></i> Update
      </button>
    </form>
  </div>
</main>

<?php include('footer.php') ?>
