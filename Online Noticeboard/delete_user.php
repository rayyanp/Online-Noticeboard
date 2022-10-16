<?php 
$uid=$_GET['uid'];
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"noticeboard");
$query = "DELETE FROM users WHERE uid='$uid'";
$query_run = mysqli_query($connection,$query);

header('location:manage_users.php');

?>