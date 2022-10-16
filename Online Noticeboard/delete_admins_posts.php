<?php 
$pid=$_GET['postid'];
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"noticeboard");
$query = "DELETE FROM posts WHERE postid='$pid'";
$query_run = mysqli_query($connection,$query);

header('location:edit_admin_posts.php');

?>