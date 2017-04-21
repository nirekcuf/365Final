<?php
$configs=include('database/config.php');
$servername = $configs['host'];
$username = $configs['username'];
$password = $configs['password'];
$dbname = $configs['dbname'];
$PASS= $_POST["password"];  
$VPASS= $_POST["vpassword"]; 
if ($VPASS==$PASS){
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql and bind parameters
$stmt = $conn->prepare("INSERT INTO Accounts (firstname, lastname, email, password)
VALUES (:firstname, :lastname, :email, :password)");
$stmt->bindParam(':firstname', $FIRSTNAME);
$stmt->bindParam(':lastname', $LASTNAME);
$stmt->bindParam(':email', $EMAIL);
$stmt->bindParam(':password', $PASS);
$FIRSTNAME= $_POST["firstName"]; 
$LASTNAME= $_POST["lastName"]; 
$EMAIL=   $_POST["Username"];  
$stmt->execute();
$conn = null; 
header('Refresh: 0; URL = imdlogin.php?UN='.$EMAIL.'&PWN='.$PASS);
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
$conn = null;
}
}else{
header('Refresh: 0; URL = failed.html');
}
?>
