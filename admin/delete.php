<?php
$conn=mysqli_connect("localhost","root","","workshop") or die("Check the database");
if(isset($_GET['ids']))
{	$id=$_GET['ids'];
	$sql="delete from category where id='$id'";
	$query=mysqli_query($conn,$sql) or die("Check the Query");
	header("location:view_photo.php");
}
?>