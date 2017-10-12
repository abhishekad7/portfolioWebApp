<?php

$servername="localhost";
$username="root";
$password="akk";
$dbname="portfolio";

function test_input($data) {
	if(empty($data)){
		header('Location: /softablitz/portfolio/index.php');
		die();
	}
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
  	return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$name=test_input($_POST["newname"]);
	$email=test_input($_POST["newemail"]);
	$web=$_POST["newweb"];
	$fb=$_POST["newfb"];
	$tweet=$_POST["newtweet"];
	$linkedin=$_POST["newlinkedin"];
	$motto=test_input($_POST["newmotto"]);
	$about=test_input($_POST["aboutme"]);
	$achieve=test_input($_POST["achieve"]);
	$whatdo=test_input($_POST["whatdo"]);
	$pass=test_input($_POST["newpass"]);
	$cnfpass=test_input($_POST["cnfnewpass"]);
	$edit=$_POST["edit"];
	$dp=0;

	if($pass!=$cnfpass){
		echo "Password do not matched";
		die();
	}

	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn){
		echo "Cannot connect to server Please Try Again.";
		die();
	}

	if($edit=="new"){

		$sql="SELECT id FROM users ORDER BY id DESC";
		$result=mysqli_query($conn,$sql);
		if(!$result){
			echo "<script>alert('Can't Connect to portfolio, Please Try Again.');window.location='index.php';</script>";
		}
		$row=mysqli_fetch_assoc($result);
		$id=$row["id"]+1;

		$sql="INSERT INTO users () VALUES ($id,'$name','$email','$web','$fb','$tweet','$linkedin','$motto','$about','$achieve','$whatdo','$pass',0)";
		if(mysqli_query($conn,$sql)){
			echo "<h1>Your Portfolio link is <a href='index.php?id=$id' style='text-decoration:none; color:blue;' id='link'></a><br>Your Portfolio Id is $id</h1>";
			echo "<script type='text/javascript'>document.getElementById('link').innerHTML=window.location.hostname+'/softablitz/portfolio/index.php?id=$id' ;</script>";
			die();
		}else{
			echo "Can't Connect to portfolio, Please Try Again.";
		}
	}

	if($edit=="edit"){
		if(isset($_POST["id"])){
			$id=$_POST["id"];
		}
		$sql="UPDATE users SET name='$name', email='$email', website='$web', facebook='$fb', twitter='$tweet', linkedin='$linkedin', motto='$motto', aboutme='$about', achieve='$achieve', whatdo='$whatdo', password='$pass' WHERE id=$id";

		if(mysqli_query($conn,$sql)){
			echo "<script type='text/javascript'>alert('Portfolio Updated');window.location='index.php?id=$id';</script>";
			die();
		}else{
			echo "Can't Connect to portfolio, Please Try Again.";
		}
	}
	
}

?>