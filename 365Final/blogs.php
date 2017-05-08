<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();}
$configs=include('database/config.php');
$servername = $configs['host'];
$username = $configs['username'];
$password = $configs['password'];
$dbname = $configs['dbname'];
?>	
<!DOCTYPE html>
<html>
  <head>
    <title>Yarn Baller
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
    <div class="ColorNav" id="tour">
      <div class="w3-container w3-content w3-padding-64" style="max-width:1200px">
	  <label class="ColText w3-right w3-padding w3-margin" id="lbl" style="font-weight:bold;">New Blog
            <button  class="w3-button w3-circle w3-purple" id="btnaddtopic" onclick="func(0)">+
            </button>
          </label>
		  <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
		
		   <div class="container">  
          <form id="contact" action="addblog.php" method="post" style="display:none;">
            <fieldset>
              <input placeholder="Enter Blog Title" type="text" name="BlogName" tabindex="1" required>
            </fieldset>
            <fieldset class="selecter">
              <select id="slct"class="selecter" name="catagory" tabindex="2" required>
                <option disabled selected value="">Select Category
                </option>
                <option value="Extreme Spinning">Extreme Spinning
                </option>
                <option value="Crochet">Crochet
                </option>
				<option value="Extreme Crochetting">Extreme Crochetting
                </option>
                <option value="Left Plaited">Left Plaited
                </option>
                <option value="Right Plaited">Right Plaited
                </option>
				<option value="Yarn">Yarn
                </option>
                <option value="Knitting in Public">Knitting in Public
                </option>
                <option value="Knitting in Private">Knitting in Private
                </option>
                <option value="Personal Knitting">Personal Knitting
                </option>
                <option value="Yarn Crawl">Yarn Crawling
                </option>
                <option value="General Knitting">General Knitting
                </option>
                <option value="Other">Other
                </option>
              </select> 
              </fieldset>
            <fieldset>
              <button name="subButton" value="Add Topic" type="submit" id="contact-submit"  data-submit="...Sending">Submit
              </button>
            </fieldset>
          </form>
        </div>
        
          <?php
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql 
$stmt = $conn->prepare("SELECT blog_id, blog_name, category FROM Blogs WHERE owner_id = :owner_id ");   // select name from table where email=email and pass=pass
$stmt->bindParam(':owner_id', $_SESSION["email"]);
$stmt->execute();
$result = $stmt->fetchall(); 
$asdf;
if ($result){
$i=0;
echo " <h2 class='w3-wide w3-center'><span class='ColText'>YOUR BLOGS</span></h2>";

foreach ($result as $rows) 
{
// these are the boxes displayed on the leading page
echo "
<div class='w3-card-4 w3-third w3-shadow w3-animate-zoom ' style='max-width:30%;margin:10px;'>
<a style='position:absolute; ' href='deleteblog.php?classID=".$rows['blog_id']."'  > &#10006</a>
<a href="."pulledcontent.php?blog=".$rows['blog_id']."  > 
<img style='max-width:100%;' src='images/yarn.jpeg' alt='Norway'>
<div class='w3-container w3-center w3-white' >
<p style='margin:5px;'>".$rows['blog_name']."<hr style='margin:0px;'></p>
</div></div></a>";
}
//display nicely if no results exist
}  elseif(!$result) {
echo " <h2 class='w3-wide w3-center'><span class='ColText'>NO BLOGS</span></h2>";
echo " <h4 class='w3-wide w3-center'><span class='ColText'>BLOG ABOUT KNITTING</span></h4>";
}
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
}
$conn = null;
?>
          
        </div>
		
       
        <p class="w3-justify">
          <span class="ColText"> 
            </p>
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
    </div>
  </body>
</html>
<script type="text/javascript">
  function func(a) {
    if(a==0) {
      document.getElementById("contact").style.display="block";
      document.getElementById("btnaddtopic").style.display="none";
      document.getElementById("lbl").style.display="none";
    }
  }
</script>
