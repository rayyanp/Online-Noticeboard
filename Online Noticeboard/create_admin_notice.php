<?php
include 'header.php';
include 'helper.php';

$show_create_form = true;

if(!isset($_SESSION['uid']))
{
  echo 'You are being redirected to the home page!';
  header("Location:index.php");
}
else
{
  $uid=$_SESSION['uid'];
}

if(isset($_POST['post'])){

  $target_file = "";
  
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"noticeboard");
  $date=date("Y-m-d H:i:s");
  $uid = $_SESSION['uid'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  
  $error3 = "";
//Sanitisation and validation to ensure nothing harmful can be inserted into the database.
  $title = sanitise($title,$connection);
  $content = sanitise($content,$connection);
  $error1 = validateString($title, 1, 120);
  $error2 = validateString($content, 1, 800);

  if (isset($_FILES["fileToUpload"])&& $_FILES["fileToUpload"]["size"] > 1){

    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
  
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
  
      // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

    $error3 = validateImage($imageFileType);
  }
  //Concatanates the potential errors for validation.
  $errors = $error1.$error2.$error3;

  //If there are no errors, run the query.
  if (!$errors) {

    $query = "INSERT INTO posts (uid, title, created, content, image) VALUES($uid,'$title','$date','$content','$target_file')";
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script>alert('Posted successfully...');
      window.location.href = 'admin_view_notice.php';
      </script>";
    }
    else{
      echo "<script>alert('Post failed...try again');
      window.location.href = 'create_admin_notice.php';
      </script>";
    }
    mysqli_close($connection);
  }
  else
  {
    echo "<script>alert('Post failed... {$errors} Please fill at least the title and content and try again.');
    window.location.href = 'create_admin_notice.php';
    </script>";
  }
}


if ($show_create_form) {
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
    <h3>Create Notice</h3><br>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Title:</label>
          <input class="form-control" type="text" name="title" minlength="1" maxlength="120" placeholder="Enter your title" required>
        </div>
        <div class="form-group">
          <label>Content:</label>
          <textarea name="content" rows="8" cols="80" class="form-control" minlength="1" maxlength="800" placeholder="Type your message..." required></textarea>
        </div>
        <div class="form-group">
          <label>Upload Image:</label>
          <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
          <button class="btn btn-success" type="submit" name="post">Post</button>
      </form>
    </div>
  </div>
</section>
<?php
}
include 'footer.php';
?>
