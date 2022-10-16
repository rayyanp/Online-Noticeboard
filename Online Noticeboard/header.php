<?php
session_start();

if(isset($_POST["fontType"]))
{
  $getFont = $_POST["fontType"];
  $_SESSION['fontType'] = $getFont; 
}

if(isset($_POST["fontSize"]))
{
  $getFontSize = $_POST["fontSize"];
  $_SESSION['fontSize'] = $getFontSize; 
}

if(isset($_POST["theme"]))
{
  $getTheme = $_POST["theme"];
  $_SESSION['theme'] = $getTheme; 
}

echo <<<HEADER1
<!DOCTYPE html>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> 
HEADER1;

echo <<<HEADER2
<title>The Online Noticeboard</title>
</head>
HEADER2;
// Check if we have a cookie for font type
$currentFont = "serif";
$currentFontSize = "medium";
if(isset($_SESSION["fontType"])){
  // Set the current font to the value of the cookie
  $currentFont = $_SESSION['fontType'];
}

if(isset($_SESSION["fontSize"])){
  // Set the current font to the value of the cookie
  $currentFontSize = $_SESSION['fontSize'];
}

// Set the body with the styles
echo  '<body id="background" class="background" style="font-size:'.$currentFontSize.'; font-family:'.$currentFont.'";>';    


if(isset($_SESSION["theme"])){
  // Set the current font to the value of the cookie
  $currentTheme = $_SESSION['theme'];
  echo  '<link rel="stylesheet" id ="stylesheet" href="'.$currentTheme.'">';    
}
else
{ 
  echo '<link rel="stylesheet" id ="stylesheet" href="css/style.css">';
}

echo <<<HEADER3
    <div class="heading">The Online Noticeboard</div>
    <div id="date" class="time"></div><br>
    <div id="time" class="time"></div>
    <div id="subheading" class="body-text">The Online Noticeboard, where posts can be created and shared.</div>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="view_posts.php">View Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create_posts.php">Create Posts</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
    </ul>
  </div>
</nav>
<br>
    <button onclick="changeTheme()" class="btn btn-info" name="theme">Theme</button>
    
   <form method="POST" action="#">
    <label for="fontSelector">Choose a font family:</label>
    <select name="fontType" id="fontSelector">
    <option value="serif">Serif</option>
    <option value="sans-serif">Sans-serif</option>
    <option value="cursive">Cursive</option>
    <option value="monospace">Monospace</option>
    </select>
    <br>
    <label for="fontSize">Choose font size:</label>
    <select name="fontSize" id="fontSize">
    <option value="small">Small</option>
    <option value="medium">Medium</option>
    <option value="large">Large</option>
    </select><br>
    <button type="submit" class="btn btn-info">Set Font</button>
</form><br>

<hr>
HEADER3;
?>