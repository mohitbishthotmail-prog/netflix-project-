
<?php

$conn = mysqli_connect("localhost", "root", "", "workshop") or die("Database not connected");

$tvquery = mysqli_query($conn, "SELECT * FROM category WHERE category='TV Shows'") or die("TV Query Failed");
$mquery  = mysqli_query($conn, "SELECT * FROM category WHERE category='Movies'") or die("Movies Query Failed");
$tmquery = mysqli_query($conn, "SELECT * FROM category WHERE category='Trending Movies'") or die("Trending Query Failed");
?>

<div class="container-fluid p-0">
  <!-- Header -->
  <?php include("header.php"); ?>

  <!-- Slider -->
  <?php include("slider.php"); ?>

  <!-- Trending Movies -->

<div class="container my-5">
  <h2 class="heading_label">Trending Movies</h2>
  <div class="row g-3">
    <?php while($row = mysqli_fetch_array($tmquery)) { ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="nf_data">
          <a href="vedio.php?id=<?php echo $row['movie']; ?>"> <!-- link to movie page -->
            <img src="admin/upload/<?php echo $row['image']; ?>" class="img-fluid rounded shadow-sm hover-scale">
          </a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- Movies -->
<div class="container my-5">
  <h2 class="heading_label">Movies</h2>
  <div class="row g-3">
    <?php while($row = mysqli_fetch_array($mquery)) { ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="nf_data">
          <a href="vedio.php?id=<?php echo $row['movie']; ?>">
            <img src="admin/upload/<?php echo $row['image']; ?>" class="img-fluid rounded shadow-sm hover-scale">
          </a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- TV Shows -->
<div class="container my-5">
  <h2 class="heading_label">TV Shows</h2>
  <div class="row g-3">
    <?php while($row = mysqli_fetch_array($tvquery)) { ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="nf_data">
          <a href="vedio.php?id=<?php echo $row['movie']; ?>">
            <img src="admin/upload/<?php echo $row['image']; ?>" class="img-fluid rounded shadow-sm hover-scale">
          </a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


  <!-- Footer -->
  <?php include("footer.php"); ?>

</div>



