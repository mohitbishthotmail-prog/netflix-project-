<?php 

$conn=mysqli_connect("localhost","root","","workshop") or die("Check the database");
$sql="select * from category where category='TV Shows'";
$query=mysqli_query($conn,$sql) or die("Check the Query");
?>
<html>
	<head>
		<title>Netflix India</title>
	<link rel="stylesheet" href="stylesheet.css">
	
	
	</head>
	<body>
		<div class="container">
			<?php include_once("header.php"); ?>
			
			<!---  Tv Shows  ---->
			
			
			<div class="heading_label">TV Shows</div>
			<div class="nf_images">
				
				
				<div class="nf_images">
						<?php while($row=mysqli_fetch_array($query)) { ?>
						<div class="nf_data">
							<img src="admin/upload/<?php echo $row['image'];?>" width="200" height="200">
						</div>
						<?php } ?>
				</div>
			
			</div>

					
			<div class="footer"> &copy; Copyrights Netflix India 2025</div>
		
		</div>
	</body>
</html>