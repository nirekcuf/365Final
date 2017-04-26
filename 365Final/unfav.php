
<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();}
$configs=include('database/config.php');
$servername = $configs['host'];
$username = $configs['username'];
$password = $configs['password'];
$dbname = $configs['dbname'];
$temp=$_GET['blog'];
$classID=$temp;

try {
	//make connection to mysql database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// prepare sql and bind parameters
	$stmt = $conn->prepare("DELETE from Favourites WHERE blog_id = :classID AND  owner_id=:owner_id");
						
						$stmt->bindParam(':classID', $classID);
						$stmt->bindParam(':owner_id', $_SESSION["email"]);
						
	
	 
     //execute sql statement
	 $stmt->execute();

     header('Refresh: 0; URL = favourites.php');
	
	 }
catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }

$conn = null;
?>