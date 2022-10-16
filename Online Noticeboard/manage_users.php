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
      <h3>Manage Users</h3><br>
      <table class="table-main">
        <tr>
          <th>ID</th>
          <th>username</th>
          <th>firstname</th>
          <th>lastname</th>
          <th>Email</th>
          <th>Age</th>
          <th>City</th>
          <th>Country</th>
          <th>Phone</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>
        <?php
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"noticeboard");
        $query = "SELECT * FROM users ORDER BY uid";
        $query_run = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($query_run)){
          ?>
          <?php 
          echo "<Tr>";
          echo "<td>".$row['uid']."</td>";
          echo "<td>".$row['username']."</td>";
          echo "<td>".$row['firstname']."</td>";
          echo "<td>".$row['lastname']."</td>";
          echo "<td>".$row['email']."</td>";
          echo "<td>".$row['age']."</td>";
          echo "<td>".$row['city']."</td>";
          echo "<td>".$row['country']."</td>";
          echo "<td>".$row['phone']."</td>";
          ?>
          <td><a href="javascript:DeleteUser('<?php echo $row['uid']; ?>');"style='color:White' class="btn btn-danger"><span class='glyphicon glyphicon-trash' type="button"></span>Delete</a></td>
          <td><a href="javascript:UpdateUser('<?php echo $row['uid']; ?>');"style='color:White' class="btn btn-success"><span class='glyphicon glyphicon-trash' type="button"></span>Update</a></td>
          <?php 
          echo "</Tr>";
          ?>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</section>
<?php
include 'footer.php';
?>


