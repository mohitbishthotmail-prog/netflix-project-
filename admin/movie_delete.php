<?php
$conn=mysqli_connect("localhost","root","","workshop") or die("Check the database");
if(isset($_GET['id']))
{	$id=$_GET['id'];
	$sql="delete from movie where id='$id'";
	$query=mysqli_query($conn,$sql) or die("Check the Query");
	header("location:view_movie.php");
}