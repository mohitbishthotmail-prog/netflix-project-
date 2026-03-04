<?php
session_start();
include('config.php');
include('sidebar.php');

// Fetch all movies
$sql = "SELECT * FROM movie ORDER BY id DESC";
$result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));
?>

<main class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
  <br><br>
  <div class="card shadow-sm p-4 translucent-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-light mb-0">🎥 View Movies</h4>
    </div>

    <div class="table-responsive">
     <table class="table translucent-table table-hover align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Movie</th>
            <th>Title</th>
            <th>Director</th>
            <th>Cast</th>
            <th>Language</th>
            <th>Release Date</th>
            <th>YouTube</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result) > 0) { ?>
		  <?php $sr = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $sr++;?></td>
                <td><?php echo htmlspecialchars($row['movie']); ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['director']); ?></td>
                <td><?php echo htmlspecialchars($row['cast']); ?></td>
                <td><?php echo htmlspecialchars($row['language']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td>
                  <?php
                    // Extract YouTube video ID
                    $pattern = '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
                    if (preg_match($pattern, $row['youtube_url'], $matches)) {
                        $youtube_id = $matches[1];
                        echo '<iframe width="200" height="113" 
                                  src="https://www.youtube.com/embed/' . $youtube_id . '" 
                                  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                  allowfullscreen>
                              </iframe>';
                    } else {
                        echo "Invalid URL";
                    }
                  ?>
                </td>
                <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                <td>
                  <a href="movie_update.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary mb-1">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="movie_delete.php?id=<?php echo $row['id']; ?>" 
                     class="btn btn-sm btn-danger mb-1"
                     onclick="return confirm('Are you sure you want to delete this movie?');">
                    <i class="bi bi-trash-fill"></i>
                  </a>
                </td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="10" class="text-center text-light">No movies found</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</main>

<?php include('footer.php'); ?>
