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
      <a href="user_dashboard.php" type="button" class="btn btn-primary btn-block testButton">Dashboard</a><br>
      </div>
      <div class="row">
      <a href="edit_profile.php" type="button" class="btn btn-primary btn-block testButton">Edit Profile</a><br>
      </div>
      <div class="row">
      <a href="create_notice.php" type="button" class="btn btn-primary btn-block testButton">Create Notice</a><br>
      </div>
      <div class="row">
      <a href="edit_posts.php" type="button" class="btn btn-primary btn-block testButton">Edit Your Posts</a><br>
      </div>
      <div class="row">
      <a href="view_notice.php" type="button" class="btn btn-primary btn-block testButton">View Notices</a><br>
      </div>
      <div class="row">
      <a href="logout.php" type="button" class="btn btn-success btn-block testButton">Logout</a><br>
      </div>
    </div>
    <div class="col-md-8 m-auto block" id="main_content">
      <h2>Welcome to user Dashboard</h2>
      <p>This is the user dashboard. This website allows you to view posts as well as create posts. </p>
      <img alt="Notice" class="img-fluid" height="40%" width="60%" src="img/noticeboard.jpg">       
    </div>
  </div>
</section>
<?php
include 'footer.php';
?>
