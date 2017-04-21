<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
session_start();}
$configs=include('database/config.php');
$servername = $configs['host'];
$username = $configs['username'];
$password = $configs['password'];
$dbname = $configs['dbname'];
// Set session variables
$temp=$_GET['UN'];
$_SESSION["email"] = $temp;
$temp=$_GET['PWN'];
$_SESSION["password"] =$temp;
$_SESSION["first"] = null;
$_SESSION["last"] = null;

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql and bind parameters
$stmt = $conn->prepare("SELECT firstname, lastname  FROM Accounts WHERE email = :email AND password = :password");
$stmt->bindParam(':email', $_SESSION["email"]);
$stmt->bindParam(':password', $_SESSION["password"]);
//$EMAIL=   $_GET["Username"];  
//$PASS= $_GET["password"];  
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC); 
$asdf;
if ($result){
$i=0;
foreach ($result as $key => $value ) 
{
$asdf[$i]=$value;
$i=$i+1;
}
$dbfirst=$asdf[0];
$dblast= $asdf[1];
$_SESSION["firstname"] = $dbfirst;
$_SESSION["lastname"] = $dblast;
header("Location: homepage.php");
exit;
}  elseif(!$result) {
session_unset(); 
// destroy the session 
session_destroy(); 
header('Refresh: 0; URL = failed.html');
exit;
}
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
}
$conn = null;
?>
