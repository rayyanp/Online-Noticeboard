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

<title>User Nationality Submit Form</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("form").on("submit", function(event){
        event.preventDefault();
 
        var formValues= $(this).serialize();
 
        $.post("process_form.php", formValues, function(data){
            // Display the returned data in browser
            $("#result").html(data);
        });
    });
});
</script>
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
    <form><br>
    <h4><b>Enter the users name too see the probability of their nationality.</b></h4><br>
        <p>
            <label>Name:</label>
            <input type="text" name="name" minlength="1" maxlength="16" required>
        </p>
        <input type="submit" value="Submit" class= "btn btn-success btn-block testButton">
    </form>
    <div id="result"></div>
</div>
</section>

<?php
    include 'footer.php';
    ?>