<?php
$conn = mysqli_connect("localhost","root","","workshop") or die("Check the database");
$mquery = mysqli_query($conn,"SELECT * FROM movie WHERE movie='$_GET[id]'") or die("Check the Query");
$row=mysqli_fetch_array($mquery);
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Movie Detail Page</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="assets/style/style.css" rel="stylesheet">
</head>
<body>
  <?php include('header.php')?>

  <div class="container-fluid p-0">
    <div class="row g-0">
      <!-- Video on the left -->
      <div class="col-md-6 video-section">
        <!--<video controls autoplay muted>
          <source src="<?php echo $row['youtube_url'];?>" type="video/mp4">
          Your browser does not support HTML video.
        </video>
		
        <div class="video-overlay"></div>
        <button class="play-button">
          <div class="play-icon"></div>
          Play
        </button>-->
	  <?php
		
		$url="$row[youtube_url]";
		$pattern = '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    
		if (preg_match($pattern, $url, $matches)) {
		   $youtube_url= $matches[1]; // Video ID
		}
	

	  ?>
	  	<iframe 
    width="560" 
    height="315" 
    src="https://www.youtube.com/embed/<?php echo $youtube_url; ?>?autoplay=0&mute=1" 
    title="YouTube video player" 
    frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
    allowfullscreen>
  </iframe>
	  </div>

      <!-- Movie Details on the right -->
      <div class="col-md-6 details-section">
        <div class="details-inner"><!-- ✅ wrapped inner padding -->
          <h1><?php echo $row['title'];?></h1>
          <p><span class="info-label">Description :</span> <?php echo $row['description'];?>
          <p><span class="info-label">Director:</span> <?php echo $row['director'];?></p>
          <p><span class="info-label">Cast:</span> <?php echo $row['cast'];?></p>
          <p><span class="info-label">Language:</span> <?php echo $row['language'];?></p>
        </div>
      </div>
    </div>
  </div>

  <?php include("footer.php")?>
</body>
</html>
