<?php 
$conn = mysqli_connect("localhost","root","","workshop") or die("Check the database");

// TV Shows query
$tvquery = mysqli_query($conn,"SELECT * FROM category WHERE category='TV Shows'") or die("Check the Query");
?>

<div class="page-wrapper">
  <div class="content-wrapper container-fluid p-0">
    <!-- Header -->
    <?php include("header.php"); ?>

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
</div>

  <!-- Footer -->
  <?php include("footer.php"); ?>
</div>


