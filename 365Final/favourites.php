<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();}
include('database\config.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Daily Hooker
    </title>
    <meta charset="UTF-8">
    <link href="./images/icon.png" type="image/png" rel="shortcut icon" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="FinalCSS.css" type="text/css" rel="stylesheet" /> 
    <style>
      html,body,h1,h2,h3,h4,h5 {
        font-family: "Open Sans", sans-serif}
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <div class="w3-top">
      <div class="w3-bar w3-card-2 ColorNav">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu">
          <i class="fa fa-bars">
          </i>
        </a>
        <?php
echo "
<li class='dropdown'>
<a href='homepage.php' style='color:white;' class='w3-button w3-padding-large w3-hide-small'>Home</a>
<div class='dropdown-content'>
<a href='signout.php'>Sign-out</a>
</div>
</li>";
?>
        <a href="blogs.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">
          <span class="ColText">Your Blogs
          </span>
        </a>
        <a href="favourites.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">
          <span class="ColText">Favorites
          </span>
        </a>
      </div>
    </div>
    <!-- Page content -->
    <div class="w3-content" style="max-width:2000px;margin-top:46px">
      <!-- The Main Section -->
      <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="Main">
        <h2 class="w3-wide">Daily Hooker
        </h2>
        <p class="w3-opacity">
          <i>Knit with others
          </i>
        </p>
        <p class="w3-justify"> 
        <p>
        </p>
        </p>
    </div>
    <!-- The Tour Section -->
    <div style="background-color:#5d5c5f;" id="tour">
      <div class="w3-container w3-content w3-padding" style="max-width:1200px">
        <div class="w3-container w3-content w3-padding-64 " style="max-width:800px">
          <?php 
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
//follower content
//make file to connect to database?
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql 
$stmt = $conn->prepare("SELECT blog_id FROM Favourites WHERE owner_id = :owner_id ");   // select name from table where email=email and pass=pass
$stmt->bindParam(':owner_id', $_SESSION["email"]);
$stmt->execute();
$result = $stmt->fetchall(); 
$asdf;
if ($result){
$i=0;
echo " <h2 class='w3-wide w3-center'><span class='ColText'>BLOGS YOU ARE FOLLOWING</span></h2>";
foreach ($result as $rows) 
{
echo "
<a href="."pulledcontent.php?blog=".$rows['blog_id']."  > <div class='w3-card-4 w3-third w3-shadow w3-animate-zoom ' style='max-width:30%;margin:10px;'>
<img style='max-width:100%;' src='images/yarn.jpeg' alt='Yarn'>
<div class='w3-container w3-center w3-white'>
<p style='margin:0px;'><hr style='margin:0px;'></p>
<p style='margin:0px;'>Blog #".$rows['blog_id']."<hr style='margin:0px;'></p>
</div></div></a>"; }
}  elseif(!$result) {
echo " <h2 class='w3-wide w3-center'><span class='ColText'>YOU DON'T HAVE ANY FAVORITES</span></h2>";
echo " <h4 class='w3-wide w3-center'><span class='ColText'>START SEARCHING</span></h4>";
}
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
}
$conn = null;
?>
        </div>
        <div class="container">  
          <form id="contact" action="favnew.php" method="post">
            <fieldset>
              <input placeholder=" SEARCH FOR BLOGS" type="search" name="search" tabindex="1" required >
            </fieldset>
            <fieldset>
              <button name="subButton" value="Search" type="submit"  id="contact-submit" data-submit="...Sending">Submit
              </button>
            </fieldset>
          </form>
        </div> 
      </div>
    </div>
    </div>
  <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
    <p class="w3-medium">
      Connect with us!
    </p>
    <i class="fa fa-facebook-official w3-hover-text-indigo">
    </i>
    <i class="fa fa-instagram w3-hover-text-purple">
    </i>
    <i class="fa fa-snapchat w3-hover-text-yellow">
    </i>
    <i class="fa fa-pinterest-p w3-hover-text-red">
    </i>
    <i class="fa fa-twitter w3-hover-text-light-blue">
    </i>
    <i class="fa fa-linkedin w3-hover-text-indigo">
    </i>
  </footer>
  </body>
</html>
