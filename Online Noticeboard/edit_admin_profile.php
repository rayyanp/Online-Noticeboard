<?php
include 'header.php';
include 'helper.php';

$show_edit_form = true;

if(!isset($_SESSION['uid']))
{
  echo 'You are being redirected to the home page!';
  header("Location:index.php");
}
else
{
  $uid=$_SESSION['uid'];
}
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"noticeboard");
  $username = "";
  $firstname = "";
  $lastname = "";
  $email = "";
  $password = "";
  $age = "";
  $city = "";
  $county = "";
  $country = "";
  $phone = "";

  $query = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
  $query_run = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($query_run)){
    $username = $row['username'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $age = $row['age'];
    $city = $row['city'];
    $county = $row['county'];
    $country = $row['country'];
    $phone = $row['phone'];
  }

  $userid =$_SESSION['uid'];
  if(isset($_POST['post'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    $username = sanitise($username,$connection);
    $password = sanitise($password,$connection);
    $firstname = sanitise($firstname,$connection);
    $lastname = sanitise($lastname,$connection);
    $email = sanitise($email,$connection);
    $age = sanitise($age,$connection);
    $city = sanitise($city,$connection);
    $county = sanitise($county,$connection);
    $country = sanitise($country,$connection);
    $phone = sanitise($phone,$connection);  
    $error1 = validateString($username, 1, 32);
    $error2 = validateString($password, 1, 64);
    $error3 = validateString($firstname, 1, 64);
    $error4 = validateString($lastname, 1, 64);
    $error5 = validateEmail($email, 1, 128);
    $error6 = validateString($age, 1, 3);
    $error7 = validateString($city, 1, 32);
    $error8 = validateString($county, 1, 40);
    $error9 = validateString($country, 1, 60);
    $error10 = validateString($phone, 1, 24);
    $errors = $error1.$error2.$error3.$error4;$error5.$error6.$error7.$error8.$error9.$error10;

    if (!$errors) {
    $updatequery = "UPDATE users SET username = '$username', firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password', age = '$age', city = '$city', county = '$county', country = '$country', phone = '$phone'  WHERE uid = $userid";
    $updatequery_run = mysqli_query($connection,$updatequery);
     if($updatequery_run){
       echo "<script>alert('Updated successfully...');
       window.location.href = 'admin_dashboard.php';
       </script>";
     }
     else{
       echo "<script>alert('Update failed...try again.');
       window.location.href = 'edit_admin_profile.php';
       </script>";
     }
     mysqli_close($connection);
  }
  else
  {
    echo "<script>alert('Update failed... {$errors} try again.');
    window.location.href = 'edit_admin_profile.php';
    </script>";
  }
}

  if ($show_edit_form) {
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
      
      <div class="col-md-8 m-auto block" id="main_content">
      <h3>Edit Profile</h3><br>
      <form action="" method="post">
        <div class="form-group form-group-position">
          <label>Username:</label>
          <input type="text" class="form-control" name="username" minlength="1" maxlength="32" value="<?php echo $username;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>First Name:</label>
          <input type="text" class="form-control" name="firstname" minlength="1" maxlength="64" value="<?php echo $firstname;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>Last Name:</label>
          <input type="text" class="form-control" name="lastname" minlength="1" maxlength="64" value="<?php echo $lastname;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>Email:</label>
          <input type="email" class="form-control" name="email" minlength="1" maxlength="128" value="<?php echo $email;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>Password:</label>
          <input type="password" class="form-control" name="password" minlength="1" maxlength="64" value="<?php echo $password;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>Age:</label>
          <input type="text" class="form-control" name="age" minlength="1" maxlength="3" value="<?php echo $age;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>City:</label>
          <input type="text" class="form-control" name="city" minlength="1" maxlength="32" value="<?php echo $city;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>County:</label>
          <input type="text" class="form-control" name="county" minlength="1" maxlength="40" value="<?php echo $county;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>Country:</label>
          <input type="text" class="form-control" name="country" minlength="1" maxlength="60" value="<?php echo $country;?>" required>
        </div>
        <div class="form-group form-group-position">
          <label>Phone:</label>
          <input type="text" class="form-control" name="phone" minlength="1" maxlength="24" value="<?php echo $phone;?>" required>
        </div><br>
        <button type="submit" name="post" class="btn btn-success">Update</button>
      </form>
      </div>
    </div>
  </section>
<?php
  }
include 'footer.php';
?>
