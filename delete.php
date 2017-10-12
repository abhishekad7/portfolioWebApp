<?php


$servername="localhost";
$username="root";
$password="akk";
$dbname="portfolio";

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
  	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
$id=test_input($_POST["delid"]);
$pass=test_input($_POST["delpass"]);


$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
	echo "<script>alert('Can't Connect to portfolio, Please Try Again.');window.location='index.php?id=$id';</script>";
	die();
}

$sql="SELECT password FROM users WHERE id=$id";
$result=mysqli_query($conn,$sql);
if(!$result){
	echo "<script>alert('Can't Connect to portfolio, Please Try Again.');window.location='index.php?id=$id';</script>";
	die();
}

$row=mysqli_fetch_assoc($result);

if($pass!=$row["password"]){
	echo "<script>alert('Wrong Password');window.location='index.php?id=$id';</script>";
	die();
}

$sql="DELETE FROM users WHERE id=$id AND password='$pass'";


if(mysqli_query($conn,$sql)){
	echo "<script>alert('Portfolio Deleted');window.location='index.php';</script>";
	die();
}else{
	echo "<script>alert('Sorry, Unable to delete portfolio now.'');window.location='index.php';</script>";
	die();
}

}

?>