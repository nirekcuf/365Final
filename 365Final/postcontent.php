<?php
//start php session for current user variables
if (session_status() == PHP_SESSION_NONE) {
session_start();
include('database\config.php');
$post=$_POST["Text1"];
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql 
$stmt = $conn->prepare("INSERT INTO Blog_content (blog_id, post)
VALUES (:blog_id, :post)");   
$stmt->bindParam(':blog_id', $_SESSION["blog"]);
$stmt->bindParam(':post', $post);
//submit content to database
$stmt->execute();
//refresh page to see new post
header('Refresh: 0; URL = pulledcontent.php?blog='.$_SESSION["blog"]);
}
catch(PDOException $e)
{
echo "<br>" . $e->getMessage();
}
$conn = null;
?>
<?php 
}
