<?php
  include 'header.php';
  include 'helper.php';
  
  $show_signup_form = true;

  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"noticeboard");

  if(isset($_POST['register'])){
    $show_signup_form = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $number = $_POST['phone'];
  
    $username = sanitise($username,$connection);
    $password = sanitise($password,$connection);
    $firstname = sanitise($firstname,$connection);
    $lastname = sanitise($lastname,$connection);
    $email = sanitise($email,$connection);
    $age = sanitise($age,$connection);
    $city = sanitise($city,$connection);
    $county = sanitise($county,$connection);
    $country = sanitise($country,$connection);
    $number = sanitise($number,$connection);  
    $error1 = validateString($username, 1, 32);
    $error2 = validateString($password, 1, 64);
    $error3 = validateString($firstname, 1, 64);
    $error4 = validateString($lastname, 1, 64);
    $error5 = validateEmail($email, 1, 128);
    $error6 = validateString($age, 1, 3);
    $error7 = validateString($city, 1, 32);
    $error8 = validateString($county, 1, 40);
    $error9 = validateString($country, 1, 60);
    $error10 = validateString($number, 1, 24);
    $errors = $error1.$error2.$error3.$error4;$error5.$error6.$error7.$error8.$error9.$error10;

    if (!$errors) {
      
    $query = "INSERT INTO users VALUES(null,'$username','$password','$firstname','$lastname','$email','$age','$city','$county','$country','$number')";
    
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script>alert('Registration successfully...You may now login.');
      window.location.href = 'index.php';
      </script>";
    }
    else{
      echo "<script>alert('Registration failed... {$errors} Please try again with a different username.');
      window.location.href = 'register.php';
      </script>";
      //echo mysqli_error($connection);
      //if the error says duplicate then tell the error "This username already exists!"
      //$string = mysqli_error($connection);
      /*if (str_contains($string, 'Duplicate')) {
        echo 'This Username already exists! Try again.';
    }*/

    }
     mysqli_close($connection);
  }
  else
  {
    echo "<script>alert('Registration failed... {$errors} try again.');
    window.location.href = 'register.php';
    </script>";
  }
}

 
  if ($show_signup_form) {
    echo <<<_END
    
    <section id="login_form">
      <div class="row">
        <div class="col-md-4 m-auto block">
          <center><h4>Registration form</h4></center>
          <form action="#" method="post">
            
          <div class="form-group">
              <label>Username:</label>
                <input class="form-control" type="text" minlength="1" maxlength="32" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
              <label>Password:</label>
                <input class="form-control" type="password" minlength="1" maxlength="64" name="password" placeholder="Enter your Password" required>
            </div>
            <div class="form-group">
              <label>First Name:</label>
                <input class="form-control" type="text" minlength="1" maxlength="64" name="firstname" placeholder="Enter your First Name" required>
            </div>
            <div class="form-group">
              <label>Last Name:</label>
                <input class="form-control" type="text" minlength="1" maxlength="64" name="lastname" placeholder="Enter your Last Name" required>
            </div>
            <div class="form-group">
              <label>Email ID:</label>
                <input class="form-control" type="email" minlength="1" maxlength="128" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
              <label>Age:</label>
                <input class="form-control" type="number" minlength="1" maxlength="3" name="age" placeholder="Enter your age" required>
            </div>
            <div class="form-group">
              <label>City:</label>
                <input class="form-control" type="text" minlength="1" maxlength="32" name="city" placeholder="Enter your city" required>
            </div>
            <div class="form-group">
              <label>County:</label>
                <input class="form-control" type="text" minlength="1" maxlength="40" name="county" placeholder="Enter your county" required>
            </div>
            <div class="form-group">
              <label>Country:</label>
                <input class="form-control" type="text" minlength="1" maxlength="60" name="country" placeholder="Enter your country" required>
            </div>
            <div class="form-group">
              <label>Number:</label>
                <input class="form-control" type="text" minlength="1" maxlength="128" name="phone" placeholder="Enter your number" required>
            </div><br>
            <button class="btn btn-primary" type="submit" name="register">Register</button>
          </form><br>
          <a href="index.php">Click here to login</a>
        </div>
      </div>
    </section>
_END;
  }
  
include 'footer.php';
?>