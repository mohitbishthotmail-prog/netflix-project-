<?php
session_start();
include('config.php');

// 1) Get movie by ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM movie WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $movie_data = mysqli_fetch_assoc($result);
    } else {
        die("Movie not found!");
    }
} else {
    die("Invalid request!");
}

// 2) Handle form submission (Update)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $movie        = $_POST['movie'];
    $youtube_url  = $_POST['youtube_url'];
    $title        = $_POST['title'];
    $description  = $_POST['description'];
    $director     = $_POST['director'];
    $cast         = $_POST['cast'];
    $language     = $_POST['language'];
    $date         = $_POST['date'];

    $stmt = $conn->prepare("UPDATE movie SET movie=?, youtube_url=?, title=?, description=?, director=?, cast=?, language=?, `date`=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $movie, $youtube_url, $title, $description, $director, $cast, $language, $date, $id);

    if ($stmt->execute()) {
        header("Location: view_movie.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all movies for dropdown (optional, if you want to allow changing movie name)
$movies = $conn->query("SELECT DISTINCT movie FROM category") or die("Movie Query Failed");

// Include sidebar
include('sidebar.php');
?>

<main class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
  <br><br>
  <div class="form-container card shadow-sm p-4 translucent-card">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-light mb-0">✏️ Update Movie Details</h4>
    </div>

    <form method="POST">
      <div class="row g-3">

        <div class="col-md-6">
          <label for="movie" class="form-label text-light">Select Movie</label>
          <select name="movie" id="movie" class="form-select translucent-input text-light border-0" required>
            <option value="">Select Movie</option>
            <?php while($row = mysqli_fetch_assoc($movies)) { ?>
              <option value="<?php echo $row['movie']; ?>" 
                      <?php if($row['movie'] == $movie_data['movie']) echo 'selected'; ?>>
                <?php echo $row['movie']; ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="youtube_url" class="form-label text-light">YouTube URL</label>
          <input type="text" name="youtube_url" id="youtube_url" 
                 class="form-control translucent-input text-light border-0" 
                 value="<?php echo htmlspecialchars($movie_data['youtube_url']); ?>" required>
        </div>

        <div class="col-md-6">
          <label for="title" class="form-label text-light">Title</label>
          <input type="text" name="title" id="title" 
                 class="form-control translucent-input text-light border-0" 
                 value="<?php echo htmlspecialchars($movie_data['title']); ?>" required>
        </div>

        <div class="col-md-6">
          <label for="director" class="form-label text-light">Director</label>
          <input type="text" name="director" id="director" 
                 class="form-control translucent-input text-light border-0" 
                 value="<?php echo htmlspecialchars($movie_data['director']); ?>" required>
        </div>

        <div class="col-md-6">
          <label for="cast" class="form-label text-light">Cast</label>
          <input type="text" name="cast" id="cast" 
                 class="form-control translucent-input text-light border-0" 
                 value="<?php echo htmlspecialchars($movie_data['cast']); ?>" required>
        </div>

        <div class="col-md-6">
          <label for="language" class="form-label text-light">Language</label>
          <input type="text" name="language" id="language" 
                 class="form-control translucent-input text-light border-0" 
                 value="<?php echo htmlspecialchars($movie_data['language']); ?>" required>
        </div>

        <div class="col-md-6">
          <label for="date" class="form-label text-light">Release Date</label>
          <input type="date" name="date" id="date" 
                 class="form-control translucent-input text-light border-0" 
                 value="<?php echo htmlspecialchars($movie_data['date']); ?>" required>
        </div>

        <div class="col-12">
          <label for="description" class="form-label text-light">Description</label>
          <textarea name="description" id="description" rows="4" 
                    class="form-control translucent-input text-light border-0" required><?php echo htmlspecialchars($movie_data['description']); ?></textarea>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-gradient w-100">
            <i class="bi bi-pencil-square"></i> Update Movie
          </button>
        </div>
      </div>
    </form>

  </div>
</main>

<?php include('footer.php'); ?>
