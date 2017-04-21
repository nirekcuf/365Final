<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
$configs=include('database/config.php');
$servername = $configs['host'];
$username = $configs['username'];
$password = $configs['password'];
$dbname = $configs['dbname'];
$temp=$_GET['post'];
$classID=$temp;
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql and bind parameters
$stmt = $conn->prepare("DELETE FROM Blog_content WHERE num=:classID");
$stmt->bindParam(':classID', $classID);
$stmt->execute();
header('Refresh: 0; URL = pulledcontent.php?blog='.$_SESSION["blog"]);
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
}
$conn = null;
?>
