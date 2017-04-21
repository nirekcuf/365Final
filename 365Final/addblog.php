<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
$configs=include('database/config.php');
$servername = $configs['host'];
$username = $configs['username'];
$password = $configs['password'];
$dbname = $configs['dbname'];
$temp=$_POST['BlogName'];
$BlogName=$temp;
$temp=$_POST['catagory'];
$category=$temp;
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql and bind parameters
$stmt = $conn->prepare("INSERT INTO Blogs (owner_id, Blog_name, category)
VALUES ( :owner_id,  :Blog_name , :category)");
$stmt->bindParam(':owner_id', $_SESSION["email"]);
$stmt->bindParam(':Blog_name', $BlogName);
$stmt->bindParam(':category', $category);
$stmt->execute();
header('Refresh: 0; URL = blogs.php');
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
}
$conn = null;
?>
