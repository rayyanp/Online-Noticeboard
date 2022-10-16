<?php
//Header page loaded.
include 'header.php';
//If there is no session ID/user is not logged in, user will be redirected to index page.
if(!isset($_SESSION['uid']))
{
  echo 'You are being redirected to the home page!';
  header("Location:index.php");
}
else
{
  //if there is a session id/user is logged in - stay on the page.
  $uid=$_SESSION['uid'];
}
?>
<!-- Left sidebar for navigation -->
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
    <div class="col-md-8 m-auto block" id="main_content">
      <h2>Welcome to Admin Dashboard</h2>
      <p>This is the Admin dashboard. This website allows you to view posts as well as create posts. As the admin you have access to every user and post as well as managing them whether it would be editing, updating or deleting any posts or users.</p>
      <img alt="Notice" class="img-fluid" height="40%" width="60%" src="img/noticeboard.jpg">    
    </div>
  </div>
</section>
<?php
//Load the footer page.
include 'footer.php';
?>
