<?php 
$pid=$_GET['postid'];
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"noticeboard");
$query = "DELETE FROM posts WHERE postid='$pid'";
$query_run = mysqli_query($connection,$query);

header('location:manage_posts.php');

?>