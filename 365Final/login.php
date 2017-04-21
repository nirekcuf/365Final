<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
session_start();}
$configs=include('database/config.php');
$servername = $configs['host'];
$username = $configs['username'];
$password = $configs['password'];
$dbname = $configs['dbname'];
$temp=$_POST['Username'];
$_SESSION["email"] = $temp;
$temp=$_POST['password'];
$_SESSION["password"] =$temp;
$_SESSION["first"] = null;
$_SESSION["last"] = null;
try {//todo: verify password case matches, start main session in here
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql and bind parameters
$stmt = $conn->prepare("SELECT firstname, lastname  FROM Accounts WHERE email = :email AND password = :password");
$stmt->bindParam(':email', $_SESSION["email"]);
$stmt->bindParam(':password', $_SESSION["password"]);
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
//fills session data with data pulled from database
$dbfirst=$asdf[0];
$dblast= $asdf[1];
$_SESSION["firstname"] = $dbfirst;
$_SESSION["lastname"] = $dblast;
//to homepage after loging
//todo check if truely logged in... ie handle back button issues
header("Location: homepage.php");
exit;
}  elseif(!$result) {
session_unset(); 
// destroy the session 
session_destroy(); 
header('Refresh: 0; URL = failed.html');
}
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
}
$conn = null;
?>
