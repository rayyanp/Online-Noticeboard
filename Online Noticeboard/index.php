<?php
include 'header.php';
include 'helper.php';
$show_signin_form = false;

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"noticeboard");

if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $error1 = validateString($username, 1, 16);
    $error2 = validateString($password, 1, 16);
    $errors = $error1.$error2;
    if ($errors == "") {

    $username = sanitise($username,$connection);
    $password = sanitise($password,$connection);
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $query_run = mysqli_query($connection,$query);
    if(mysqli_num_rows($query_run))
    {
        $_SESSION['username'] = $_POST['username'];
        while($row = mysqli_fetch_assoc($query_run))
        {
            $_SESSION['uid'] = $row['uid'];
            //if $username = admin then i am admin so make a new session variable
            if ($username == "admin")
            {
            $_SESSION['admin'] = TRUE;
            echo "<script>
            window.location.href = 'admin_dashboard.php';
            </script>";
            }
            else
            {
                echo "<script>
                window.location.href = 'user_dashboard.php';
                </script>";
            }
        }
    }
    else
    {
      echo "<script>alert('Please Enter correct Username and Password');
      </script>";
    } 
mysqli_close($connection);
}
else {
    echo "<b>Sign-in Failed";
    echo "<br><br></b>";
}
}

if (isset($_SESSION['uid'])){
{
   echo 'You are already logged in, please log out first.<br><a href="logout.php" type="button" class="btn btn-success btn-block testButton">Logout</a><br>';
}
}
else
{
    $show_signin_form = true;
}
if ($show_signin_form)
{
echo <<<_END
<h2><b>Welcome to The Online Noticeboard</b></h2>
		<i> <b> Join us today and get connected. </b></i>
		<hr>
		<center><img alt="Notice"  id="imageBR1" src="img/note3.jpg"></center>
        
        <!-- Login from code starts here -->
		<div class="col-md-4 m-auto block"><br>
          <center><h4>Login:</h4></center>
          <form action="index.php" method="post">
            <div class="form-group"><br>
            <label>Username:</label>
                <input class="form-control" type="text" minlength="1" maxlength="16" name="username" placeholder="Enter your Username" required>
            </div><br>
            <div class="form-group">
              <label>Password:</label>
                <input class="form-control" type="password" minlength="1" maxlength="16" name="password" placeholder="Enter your Password" required>
            </div><br>
            <button class="btn btn-primary" type="submit" name="login">Login</button>
          </form><br>
          <a href="register.php">Click here to register</a>
        </div><br>
		<table class="table-main table-position">
        <tr>
            <th>Latest News</th>
        </tr>
        <tr>
            <td>Latest news posted here.</td>
        </tr>
        </table>
		<br>
_END;
}
include 'footer.php';
?>

