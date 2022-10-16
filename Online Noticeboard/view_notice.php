<?php
include 'header.php';
include 'helper.php';
if(!isset($_SESSION['uid']))
{
  echo 'You are being redirected to the home page!';
  header("Location:index.php");
}
else
{
  $uid=$_SESSION['uid'];
}

if(isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM posts INNER JOIN users WHERE posts.uid = users.uid ORDER BY created ASC";
    $result = executeQuery($asc_query);
}

// Descending Order
elseif (isset ($_POST['DESC'])) 
    {
          $desc_query = "SELECT * FROM posts INNER JOIN users WHERE posts.uid = users.uid ORDER BY created DESC";
          $result = executeQuery($desc_query);
    }
    
    // Default Order
 else {
        $default_query = "SELECT * FROM posts INNER JOIN users WHERE posts.uid = users.uid";
        $result = executeQuery($default_query);
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
    <h3>Notices for you</h3><br>
      <form action="view_notice.php" method="post">
        <input type="submit" class = "btn btn-info" name="ASC" value="Ascending">
        <input type="submit" class = "btn btn-info" name="DESC" value="Descending"><br><br>
    <table class="table-main">
    <tr>
      <th>Title</th>
      <th>Content</th>
      <th>Images</th>
      <th>Created</th>
    </tr>
<?php
function executeQuery($query)
{
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"noticeboard");
    $result = mysqli_query($connection, $query);
    return $result;
}
while($row = mysqli_fetch_assoc($result)){
  ?> 
<tr>
    <td><?php echo $row['title'];?></td>
    <td><?php echo $row['content'];?></td>
    <td><img src="<?php echo $row['image'];?>" class="img" width="100px" height="100px"></td>
    <td>Created:<?php echo $row['created'];?><br>By:<?php echo $row['firstname'];?><br><?php echo $row['username'];?></td>
</tr>
  <?php
}
?>
      </table>
      </form>
    </div>
  </div>
</section>
<?php
include 'footer.php';
?>

