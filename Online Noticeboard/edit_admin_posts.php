<?php
include 'header.php';

if(!isset($_SESSION['uid']))
{
  echo 'You are being redirected to the home page!';
  header("Location:index.php");
}
else
{
  $uid=$_SESSION['uid'];
}
?>
<section id="container">
      <div class="row">
      <div class="col-md-2" id="left_sidebar">
      <center><img src="img/profile.png" class="img-fluid" width="50%" height="50%"></center><br>      
      <center><b><?php echo $_SESSION['username'];?></b></center><hr>
      <div class="row">
      <a href="admin_dashboard.php" type="button" class="btn btn-primary btn-block testButton">Dashboard</a><br>
      </div>
      <div class="row">
      <a href="edit_admin_profile.php" type="button" class="btn btn-primary btn-block testButton">Edit Profile</a><br>
      </div>
      <div class="row">
      <a href="create_admin_notice.php" type="button" class="btn btn-primary btn-block testButton">Create Notice</a><br>
      </div>
      <div class="row">
      <a href="admin_view_notice.php" type="button" class="btn btn-primary btn-block testButton">View Notices</a><br>
      </div>
      <div class="row">
      <a href="edit_admin_posts.php" type="button" class="btn btn-primary btn-block testButton">Edit Your Posts</a><br>
      </div>
      <div class="row">
      <a href="manage_posts.php" type="button" class="btn btn-primary btn-block testButton">Manage Posts</a><br>
      </div>
      <div class="row">
      <a href="manage_users.php" type="button" class="btn btn-primary btn-block testButton">Manage Users</a><br>
      </div>
      <div class="row">
      <a href="stats.php" type="button" class="btn btn-primary btn-block testButton">User Nationalities</a><br>
      </div>
      <div class="row">
      <a href="logout.php" type="button" class="btn btn-success btn-block testButton">Logout</a><br>
      </div>
    </div>
        <div class="col-md-8" id="main_content">
        <h3>Edit Your Posts</h3><br>
        <table class="table-main">
          <tr>
            <th>Post ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Created</th>
            <th>Delete</th>
            <th>Update</th>
          </tr>
<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"noticeboard");
$query = "SELECT * FROM posts WHERE uid = $uid ORDER BY postid DESC"; 
$query_run = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($query_run)){
  ?>
        
<?php 
echo "<Tr>";
echo "<td>".$row['postid']."</td>";
echo "<td>".$row['title']."</td>";
echo "<td>".$row['content']."</td>";
?>
<td><img src="<?php echo $row['image'];?>" class="img" width="100px" height="100px"></td>
<?php 
echo "<td>".$row['created']."</td>";
?>
<!-- When the update/delete button is clicked the following javascript function will run. -->
<td><a href="javascript:AdminDeletePost('<?php echo $row['postid']; ?>')"style='color:White' class="btn btn-danger"><span class='glyphicon glyphicon-trash' type="button"></span>Delete</a></td>
<td><a href="javascript:AdminUpdatePost('<?php echo $row['postid']; ?>');"style='color:White' class="btn btn-success"><span class='glyphicon glyphicon-trash' type="button"></span>Update</a></td>
<?php 
echo "</Tr>";
		?>
  <?php
}
?>
      </table>
    </div>
  </div>
</section>
<?php
include 'footer.php';
?>

