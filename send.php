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
	$name=test_input($_POST["msgname"]);
	$email=test_input($_POST["msgemail"]);
	$id=test_input($_POST["msgid"]);
	$msg=test_input($_POST["msg"]);

	$conn=mysqli_connect($servername, $username, $password, $dbname);

	$sql="SELECT email FROM users WHERE id=$id";

	//Executing sql query
	$result=mysqli_query($conn, $sql);
	if(!$result){
		echo "<script>alert('Cannor Connect to Server, Please Try Again.');window.location='index.php?id=$id';</script>";
		die();
	}

	if(mysqli_num_rows($result)==0){
		echo "<script>alert('Portfolio do not exist');window.location='index.php';</script>";
		die();
	}
	$row=mysqli_fetch_assoc($result);

	$sendtoemail=$row["email"];

	$to = $sendtoemail;
	$subject = "Portfolio Viewer";
	$txt = "From $name<br>$msg";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";	
	$headers .= "From: help@portfolio.com\r\nReply-to: $email";
	if(mail($to,$subject,$txt,$headers)){
		echo "<script type='text/javascript'>alert('Your Message is sent.');window.location='index.php?id=$id';</script>";
	}
	else{
		echo "<script type='text/javascript'>alert('Unable to send Message');window.location='index.php?id=$id';</script>";
	}
}
?>