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
	$id=$_POST["editid"];
	$pass=$_POST["editpass"];

	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn){
		echo "<script>alert('Can't Connect to portfolio, Please Try Again.');window.location='index.php?id=$id#contact';</script>";
		die();
	}

	$sql="SELECT * FROM users WHERE id=$id AND password='$pass'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)==0){
		echo "<script>alert('Wrong Password');window.location='index.php?id=$id#contact';</script>";
		die();
	}

	$row=mysqli_fetch_assoc($result);

	$name=$row["name"];
	$email=$row["email"];
	$web=$row["website"];
	$fb=$row["facebook"];
	$tweet=$row["twitter"];
	$linkedin=$row["linkedin"];
	$motto=$row["motto"];
	$about=$row["aboutme"];
	$achieve=$row["achieve"];
	$whatdo=$row["whatdo"];

	$dplink="dps/dp1.jpg";
}
?>

<!doctype html>
<html>
	<head>
		<title>Update</title>
		<link rel="shortcut icon" href="<?php echo $dplink;?>">

		<style type="text/css">
			body {
				background-color: #c5d1e5;
			}

			input , textarea{
				background-color: #e8eaed;
				display: block;
				width:85%;
				max-width: 85%;
				min-width: 85%;
				height:38px;
				color:rgb(66, 134, 244);
				font-size: 16px;
				padding-left: 5px;
				border: 2px solid rgb(66, 134, 244);
				border-radius: 5%;
				border-bottom: 8px solid rgba(0,0,0,0);
			}
			button {
				background-color: rgb(66, 134, 244);
				height: 30px;
				width: 40%;
				color: #fefefe;
				font-weight: bold;
				letter-spacing: 4px;
			}
			legend {
				font-weight: bold;
				color: rgb(66, 134, 244);
				font-variant: small-caps;
				letter-spacing: 4px;
			}
		</style>

	</head>
	<body>
		<br>
		<center>
			<fieldset style="width: 80%;">
				<legend>Update Portfolio</legend><br>
				<center>
				<form  action='new.php' method='post' onsubmit="return validatenew()">
					<div class='lfcontainer'>
						<center><span id="fillerr" style="display:none;color:red;font-weight: bold;"></span></center>
						<input type="text" name="newname" id="newname" placeholder="Your Fullname" value="<?php echo $name; ?>" onkeyup="validatename()" maxlength="200" required>
						<input type="text" name="newmotto" id="newmotto" placeholder="Your Motto" maxlength="48" value="<?php echo $motto; ?>" required>
						<input type="email" name="newemail" id='newemail' placeholder="Your Email" value="<?php echo $email; ?>" onkeyup="validateemail()" required>
						<input type="password" name="newpass" placeholder="New Password" maxlength="100" id="newpass" value="<?php echo $pass;?>" onkeyup="validatecnfpass()" required>
						<input type="password" name="cnfnewpass" id="cnfnewpass" placeholder="Confirm New Password" onkeyup="validatecnfpass()" value="<?php echo $pass;?>" required>
						<input type="url" name="newweb" id="newweb" placeholder="Your website or Blog link" value="<?php echo $web; ?>" maxlength="200">
						<input type="url" name="newfb" id='newfb' value="<?php echo $fb; ?>" placeholder="Your Facebook Profile link or Page link" maxlength="200">
						<input type="url" name="newtweet" id='newtweet' value="<?php echo $tweet; ?>" placeholder="Your Twitter Profile link" maxlength="100">
						<input type="url" name="newlinkedin" id='newlinkedin' value="<?php echo $linkedin; ?>" placeholder="Your Linkedin Profile link" maxlength="100">
						<textarea id="aboutme" name="aboutme" placeholder="About You"  maxlength="500" style="width: 85%; max-height: 100px;min-height: 100px;max-width: 85%; min-width: 85%;" required><?php echo $about; ?></textarea>
						<textarea id="achieve" name="achieve" placeholder="Your Education and Achievements" maxlength="500" style="width: 100%; max-height: 100px;min-height: 100px;max-width: 85%; min-width: 85%;" required><?php echo $achieve; ?></textarea>
						<textarea id="whatdo" name="whatdo" placeholder="What do you do?"  maxlength="500" style="width: 85%; max-height: 100px;min-height: 100px;max-width: 85%; min-width: 85%;" required><?php echo $whatdo; ?></textarea>
						<input type="hidden" id="edit" name="edit" value="edit">
						<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
						<button type='submit' id='newsubmit' onmouseover="this.style.cursor='pointer'">Update Portfolio</button>
					</div>
				</form>
				<br>
			</center>
			</fieldset>
		</center>
	</body>
	<script type="text/javascript">
		function validatename(){
			obj=document.getElementById('newname');
			str=obj.value;
			n=str.search(/[^a-zA-Z\s]/i);
			if(n!=-1){
				obj.style.borderColor="red";
				document.getElementById('newsubmit').disabled=true;
				return false;
			}
			else{
				document.getElementById('newsubmit').disabled=false;
				obj.style.borderColor="";
				return true;
			}
		}
		function validatecnfpass(){
			obj=document.getElementById('cnfnewpass');
			str=obj.value;
			pass=document.getElementById('newpass').value;
			if(str!=pass){
				obj.style.borderColor="red";
				document.getElementById('newsubmit').disabled=true;
				document.getElementById('fillerr').innerHTML="Password do not match";
				document.getElementById('fillerr').style.display="inline-block";	
				return false;
			}
			else{
				obj.style.borderColor="";
				document.getElementById('newsubmit').disabled=false;
				document.getElementById('fillerr').style.display="none";
				return true;
			}
		}

		function validateemail(){
			obj=document.getElementById('newemail');
			email=obj.value;
			re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
			if(re.test(email)){
				obj.style.borderColor="";
				document.getElementById('newsubmit').disabled=false;
				document.getElementById('fillerr').style.display="none";
				return true;
			}
			else{
				obj.style.borderColor="red";
				document.getElementById('newsubmit').disabled=true;
				document.getElementById('fillerr').innerHTML="Invalid Email";
				document.getElementById('fillerr').style.display="inline-block";	
				return false;
			}
		}

		function validatenew(){
			if(validateuser() && validateemail() && validatecnfpass() && validatename()){
				return true;
			}
			else{
				return false;
			}
		}

	</script>
</html>
