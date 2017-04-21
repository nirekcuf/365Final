
<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();}
$vistitorID;
$servername = "huddledatabase.cjr09iq71xkk.us-east-1.rds.amazonaws.com:3306";
$username = "Aministrator";
$password = "Engineering77";
$dbname = "Knitting";
$blog = $_GET['blog'];
$_SESSION["blog"]=$blog;


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// prepare sql 
	 $stmt = $conn->prepare("SELECT blog_id, blog_name, owner_id, category FROM Blogs WHERE blog_id = :blog_id");   
	 $stmt->bindParam(':blog_id', $blog);

   $stmt->execute();
   
	
	
	  $result = $stmt->fetchall(); 
	   
	?>	
	
	
		<!DOCTYPE html>
<html>
  <head>
    <title>Daily Hooker</title>
    <meta charset="UTF-8">
	<link href="./images/icon.png" type="image/png" rel="shortcut icon" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="FinalCSS.css" type="text/css" rel="stylesheet" /> 
	<style>
      html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
    </style>
  </head>
  
  <body>
	
	<!-- Navbar -->
	<div class="w3-top">
	  <div class="w3-bar w3-card-2 ColorNav">
		<a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
		 <?php
		 echo "
		  <li class='dropdown'>
	    <a href='homepage.php' style='color:white;' class='w3-button w3-padding-large w3-hide-small'>Welcome ".$_SESSION['firstname']."</a>
		<div class='dropdown-content'>
            
			<a href='signout.php'>Sign-out</a>
	    </div>
	  </li>";
		 
	?><a href="blogs.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><span class="ColText">Your Blogs</span></a>
		<a href="favourites.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><span class="ColText">Favorites</span></a>
		
	 </div>
	</div>

	<!-- Page content -->
	<div class="w3-content" style="max-width:2000px;margin-top:46px">

	<!-- The Band Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
      
	
	
	
	

<?php 





	   
	   
	  
    if ($result){
		
      
        
             foreach ($result as $rows){
			$vistitorID =$rows['owner_id'];
			 $blogname = strtoupper($rows['blog_name']);
			 echo"	  <h2 class='w3-wide'>THE ".$blogname." BLOG</h2>";}
 echo" <p class='w3-opacity'><i>Tell your friends to favorite blog #".$rows["blog_id"]." from the ".$rows['category']." category</i></p>
	 <i class='w3-opacity' style='float:top;' >Knitting with others</i>";?>
      
	  
	  <p class="w3-justify">
	 
	  </p>
    </div>
	
	<!-- The Tour Section notify button-->
    <div class="ColorNav" id="tour">
      <div class="w3-container w3-content w3-padding-64" style="max-width:1200px">
	  
	
	  
	  
	 

	  <p class="w3-justify"><span class="ColText">
			
			
			<?php
			
			
		
			
		
    
		
		

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// prepare sql 
	 $stmt = $conn->prepare("SELECT post, num FROM Blog_content WHERE blog_id = :blog_id ");   // select name from table where email=email and pass=pass
	$stmt->bindParam(':blog_id', $_SESSION["blog"]);

   $stmt->execute();
   
	
	
	
	
	
	
	  $result = $stmt->fetchall(); 
	   
	   
	   
	   
	   $asdf;
    if ($result){
		$i=0;
      
        foreach ($result as $rows) 
         {
           
         
		   echo " <div class='w3-card-4 w3-margin'>

			<header class='w3-container '>
			<h1 class='ColText'> </h1>
			</header>

			<div class='w3-container w3-white'>
				<p>".$rows["post"]."</p>
				<span id='unhide' style='padding-left:5em; display:none; '   ><a  href='deletepost.php?post=".$rows['num']."' style='color:red;'>remove &#10006</a></span>

				</div>



</div>";
         }
    
		
		
		
		
		
	  }  elseif(!$result) {
		  
		  echo "
		  <div class='w3-card-4'>

			<header class='w3-container '>
			<h1 class='ColText'> </h1>
			</header>

			<div class='w3-container w3-white'>
				<p>No content posted</p>
				
				</div>



</div>
		  ";
		  }
	
	 
	
	 }
catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }

$conn = null;


		
		
		
	  }  elseif(!$result) {
		  
		  echo "Error Has occuried in pulledcontent.php";
		  }
	
	 }
catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }

$conn = null;
 ?>
 </p>
 	  </div>
        </div>
		</br></br>

	  <?php 
	  
	  
	  
	  
	  
	  if($vistitorID==$_SESSION['email']){
	  
	  
	  
	
	  ?>
	  
	  
	  
	  <script type="text/javascript">
  document.getElementById("unhide").style.display = "inline";
</script>
	
	   
  <form id="contact" action="postcontent.php" method="post" class="container" style="display:block;max-width:20%;">
   
    
	  <textarea name="Text1" placeholder="Talk About Something" cols="40" rows="50"></textarea><br/>
    
   
   
    <fieldset>
      <button name="subButton" value="Add Topic" type="submit" id="contact-submit" >Submit Post</button>
    </fieldset>
   
  
   
  </form>
  
	 
	  
	  <?PHP } ?>

</body>
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
	  <p class="w3-medium">
	  Connect with us!
	  </p>
	  <i class="fa fa-facebook-official w3-hover-text-indigo"></i>
	  <i class="fa fa-instagram w3-hover-text-purple"></i>
	  <i class="fa fa-snapchat w3-hover-text-yellow"></i>
	  <i class="fa fa-pinterest-p w3-hover-text-red"></i>
	  <i class="fa fa-twitter w3-hover-text-light-blue"></i>
	  <i class="fa fa-linkedin w3-hover-text-indigo"></i>
	</footer>
	
 
	
  
</html>



	