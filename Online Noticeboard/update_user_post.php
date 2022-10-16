<?php 
include 'header.php';
include 'helper.php';

$show_update_form = true;

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
    $pid=$_GET['postid'];
    $title = "";
    $content = "";
    $query = "SELECT * FROM posts WHERE postid = $pid";
    $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $title = $row['title'];
      $content = $row['content'];
    }


  if(isset($_POST['post'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date=date("Y-m-d H:i:s");
    $target_file = "";
    $error3 = "";

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
    $errors = $error1.$error2.$error3;


    if (!$errors) {
    $updatequery = "UPDATE posts SET title = '$title', content = '$content', created = '$date', image = '$target_file' WHERE postid = '$pid' ";
    $updatequery_run = mysqli_query($connection,$updatequery);
     if($updatequery_run){
       echo "<script>alert('Updated successfully...');
       window.location.href = 'edit_posts.php';
       </script>";
     }
     else{
       echo "<script>alert('Update failed...try again');
       window.location.href = 'update_user_post.php';
       </script>";
     }
     mysqli_close($connection);
  }
  else
  {
    echo "<script>alert('Update failed... {$errors} Please fill in the title and content atleast and try again.');
    window.location.href = 'edit_posts.php';
    </script>";
  }
}
if ($show_update_form) {
?>
<br>
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
<h2>Update Post</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group form-group-position">
      <label>Title:</label>
      <input type="text" class="form-control" name="title" minlength="1" maxlength="120" value="<?php echo $title;?>" required>
    </div>
    <div class="form-group form-group-position">
      <label>Content:</label>
      <textarea type="text" name="content" minlength="1" maxlength="800" rows="8" cols="80" class="form-control" placeholder="Type your message..." value="<?php echo $content;?>" required></textarea>
    </div>
    <div class="form-group">
      <label>Upload Image:</label>
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <button type="submit" name="post" class="btn btn-primary">Update</button>
  </form>
  </div>
</div>
</section>
<?php
}
include 'footer.php';
?>

