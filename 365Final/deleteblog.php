
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$servername = "huddledatabase.cjr09iq71xkk.us-east-1.rds.amazonaws.com:3306";
$username = "Aministrator";
$password = "Engineering77";
$dbname = "Knitting";
$temp=$_GET['classID'];
$classID=$temp;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// prepare sql and bind parameters
	$stmt = $conn->prepare("DELETE FROM Blogs WHERE blog_id=:classID");
						
						$stmt->bindParam(':classID', $classID);
						
	
	 
     
	 $stmt->execute();

     header('Refresh: 0; URL = blogs.php');
	
	 }
catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }

$conn = null;
?>