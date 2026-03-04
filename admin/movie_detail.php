<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "workshop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission BEFORE including sidebar or any HTML
if ($_SERVER['REQUEST_METHOD'] == "POST")  {
    $movie        = $_POST['movie'];
    $youtube_url  = $_POST['youtube_url'];
    $title        = $_POST['title'];
    $description  = $_POST['description'];
    $director     = $_POST['director'];
    $cast         = $_POST['cast'];
    $language     = $_POST['language'];
    $date         = $_POST['date'];

    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO movie 
        (movie, youtube_url, title, description, director, cast, language, `date`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $movie, $youtube_url, $title, $description, $director, $cast, $language, $date);

    if ($stmt->execute()) {
        header("Location: view_movie.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch movies for dropdown
$movies = $conn->query("SELECT DISTINCT movie FROM category") or die("Movie Query Failed");

// Include sidebar AFTER handling redirect
include('sidebar.php');
?>


<main class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
  <br>
  <br>
  <div class="form-container card shadow-sm p-4 translucent-card">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-light mb-0">🎬 Add Movie Details</h4>
    </div>

    <form method="POST">
      <div class="row g-3">
        
       <div class="col-md-6">
		  <label for="movie" class="form-label text-light">Select Movie</label>
		  <select name="movie" id="movie" class="form-select translucent-input text-light border-0" required>
			<option value="">Select Movie</option>
			<?php while($row = mysqli_fetch_assoc($movies)) { ?>
			  <option value="<?php echo $row['movie']; ?>"><?php echo $row['movie']; ?></option>
			<?php } ?>
		  </select>
		</div>


        <div class="col-md-6">
          <label for="youtube_url" class="form-label text-light">YouTube URL</label>
          <input type="text" name="youtube_url" id="youtube_url" 
                 class="form-control translucent-input text-light border-0" required>
        </div>

        <div class="col-md-6">
          <label for="title" class="form-label text-light">Title</label>
          <input type="text" name="title" id="title" 
                 class="form-control translucent-input text-light border-0" required>
        </div>

        <div class="col-md-6">
          <label for="director" class="form-label text-light">Director</label>
          <input type="text" name="director" id="director" 
                 class="form-control translucent-input text-light border-0" required>
        </div>

        <div class="col-md-6">
          <label for="cast" class="form-label text-light">Cast</label>
          <input type="text" name="cast" id="cast" 
                 class="form-control translucent-input text-light border-0" required>
        </div>

        <div class="col-md-6">
          <label for="language" class="form-label text-light">Language</label>
          <input type="text" name="language" id="language" 
                 class="form-control translucent-input text-light border-0" required>
        </div>

        <div class="col-md-6">
          <label for="date" class="form-label text-light">Release Date</label>
          <input type="date" name="date" id="date" 
                 class="form-control translucent-input text-light border-0" required>
        </div>

        <div class="col-12">
          <label for="description" class="form-label text-light">Description</label>
          <textarea name="description" id="description" rows="4" 
                    class="form-control translucent-input text-light border-0" required></textarea>
        </div>

        <div class="col-12">
          <button type="submit" name="submit" class="btn btn-gradient w-100">
            <i class="bi bi-upload"></i> Add Movie
          </button>
        </div>
      </div>
    </form>

  </div>
</main>





