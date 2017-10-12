<?php
$servername="localhost";
$username="root";
$password="akk";
$dbname="portfolio";
$id=1;
if(isset($_GET["id"])){
	$id=$_GET["id"];
	if(!is_numeric($id)){
		$id=0;
	}
}


$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
	echo "<script>alert('Can't Connect to portfolio, Please Try Again.');window.location='index.php?id=$id';</script>";
	die();
}

$sql="SELECT * FROM users WHERE id=$id" ;

$result=mysqli_query($conn, $sql);
if(!$result){
	echo "<script>alert('Can't Connect to portfolio, Please Try Again.');window.location='index.php?id=$id';</script>";
	die();
}

if(mysqli_num_rows($result)==0){
	echo "<script>alert('Portfolio do not exist');window.location='index.php';</script>";
	die();
}

$row=mysqli_fetch_assoc($result);
$name=$row["name"];
$email=$row["email"];
$website=$row["website"];
$fb=$row["facebook"];
$tweet=$row["twitter"];
$linkedin=$row["linkedin"];
$motto=$row["motto"];
$about=$row["aboutme"];
$achieve=$row["achieve"];
$whatdo=$row["whatdo"];
$dp=$row["dp"];
$dplink="";
if($dp==1){
	$dplink="dps/dp".$id.".jpg";
}else{
	$dplink="dps/dp1.jpg";
}
?>

<!doctype html>
<html>
<head>
	<title>Portfolio</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?php echo $dplink;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	body {
		font: 20px;
	}
	p {
		font-size: 16px;
	}
	.margin {
		margin-bottom: 45px;
	}
	.bg-1 { 
	  	background-color: #1abc9c; /* Green */
	  	color: #ffffff;
	}
	.bg-2 { 
	  	background-color: #474e5d; /* Dark Blue */
	  	color: #ffffff;
	}
	.bg-3 { 
	  	background-color: #eddada; /* White */
	  	color: #db7400;
	}
	.bg-4 { 
	  	background-color: #2f2f2f; /* Black Gray */
	  	color: #fff;
	}
	.container-fluid {
	  	padding-top: 30px;
	  	padding-bottom: 40px;
	}
	.navbar {
	  	padding-top: 15px;
	  	padding-bottom: 15px;
	  	border: 0;
	  	border-radius: 0;
	  	margin-bottom: 0;
	  	font-size: 12px;
	  	letter-spacing: 5px;
	}
	.navbar-nav  li a:hover {
	  	color: #1abc9c !important;
	}
	.about {
		display: block;

	}
	.msg input,.msg textarea {
		display: block;
		width:50%;
		max-width: 50%;
		min-width: 50%;
		height:38px;
		color:#000;
		padding-left: 5px;
		border: 1px solid rgba(0,0,0,0.5);
		border-radius: 5%;
		border-bottom: 8px solid #2f2f2f;
	}
	.lfcontain {
		position: fixed;
		display: none;
		z-index: +2;
		width: 100%;
		height: 100%;
		left:0%;
		top:0%;
		overflow: auto;
		background-color: rgba(0,0,0,0.2);
	}

	.lfcontainer input {
		width:100%;
		padding: 8px 12px;
		margin: 5px 0;
		display: inline-block;
		border: 1px solid #ccc;
	}

	.lfcontainer button {
		background-color: #48d1cc;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		widows: 100%;
	}

	.imgcontain {
		text-align: center;
		margin: 24px 0 12px 0;
		position: relative;
	}

	img.avatar {
		width: 10%;
		overflow: hidden;
		border: 1px solid #ccc;
		border-radius: 50%;
	}

	.lfcontainer {
		padding: 16px;
	}

	.loginform {
		background-color: #fefefe;
		margin: 5% auto 15% auto;
		border: 1px solid #888;
		width: 70%;
	}

	.close {
		position: absolute;
		right: 25px;
		top: 0;
		color: #000;
		font-size: 35px;
		font-weight: bold;
	}

	.close:hover, .close:focus {
		color: red;
		cursor: pointer;
	}

	.lfanimate {
		-webkit-animation: animatezoom 0.6s;
		animation: animatezoom 0.6s;
	}

	@-webkit-keyframes animatezoom {
		from {-webkit-transform: scale(0)}
		to {-webkit-transform: scale(1)}
	}

	@keyframes animatezoom {
		from {transform: scale(0)}
		to {transform: scale(1)}			
	}

	</style>
</head>

<body>

<!-- Top Bar -->

<nav class="navbar navbar-default">
  	<div class="container">
    	<div class="navbar-header">
      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>                        
      	</button>
      	<a class="navbar-brand" href="index.php">Portfolio</a>
	      	<form action='index.php' method='get' style="display: inline-block;">
	      		<input type="number" style="display: inline;" placeholder=" Portfolio Id" name="id" style="width:180px" required><input style="display: inline; color:#fefefe;background-color: #4a89ef; font-weight: bold; letter-spacing: 5px;" type="submit" value="Go">
	      	</form>
    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      	<ul class="nav navbar-nav navbar-right">
    			<li><a href='#about'>ABOUT</a></li>
				<li><a href='#contact'>CONTACT</a></li>
				<li><a href='#' onclick="shownew()">CREATE YOURS</a></li>
	      	</ul>
	    </div>
  	</div>
</nav>

<!-- DP FORM-->

<div name='dpcontain' id='dpcontain' class='lfcontain'>
	<form class='loginform lfanimate' action="uploaddp.php" method="post" enctype="multipart/form-data">
		<div class='imgcontain'>
			<span onclick="document.getElementById('dpcontain').style.display='none'" class='close' title='Close'>&times;</span>
			<p style="color: blue;">Upload Your Picture</p>
		</div>
		<div class='lfcontainer'>
			 Select image to upload:
		    <input type="file" name="dp" id="dp" required>
		    <input type="hidden" name="dpid" id="dpid" value="<?php echo $id;?>">
		    <input type="password" name="uploadpass" id="uploadpass" placeholder="Your Password" required>
			<center><span id="dperr" style="display:none;color:red;font-weight: bold;"></span></center>
			<button type="submit" id="dpsubmit">Upload Image</button>
		</div>
	</form>
</div>


<!-- First Container -->

<div class="container-fluid bg-1 text-center">
  	<h1 class="margin" style="font-variant: small-caps;"><?php echo $name;?></h1><hr width="50%" style="height: 3px;background-color: #c40000;border: .1px solid red;border-radius: 50%">
  	<img src="<?php echo $dplink;?>" class="img-responsive img-circle margin" onmouseover="this.style.cursor='pointer'" onclick="<?php if($id!=1){echo 'uploaddpform()';}?>" style="display:inline" alt="Name" width="400" height="400">
  	<h3><?php echo $motto ?></h3>
</div>


<!-- Second Container -->
<div class="container-fluid bg-3 text-center">
  	<h2 class="margin" name="about" id="about" style="font-variant: small-caps;">About</h2>
  	<center>
  	<table border="0" width="95%"><tr>
  	<td width="33.33%"  style="text-align: center; vertical-align: top;">
	  	<div style="font-variant: small-caps; font-size: 20px">About Me<hr width="50%" style="height: 3px;background-color: #c40000;border: .1px solid red;border-radius: 50%"></div>
	  	<div style="font-family: 'Segoe Print'; font-size:15px"><?php echo $about; ?></div>
  	</td>
  	<td width="33.34%" style="text-align: center; vertical-align: top;">
	  	<div style="font-variant: small-caps; font-size: 20px">What I've Done<hr width="50%" style="height: 3px;background-color: #c40000;border: .1px solid red;border-radius: 50%"></div>
	  	<div style="font-family: 'Segoe Print'; font-size:15px"><?php echo $achieve; ?></div>
  	</td>
  	<td width="33.33%" style="text-align: center; vertical-align: top;">
	  	<div style="font-variant: small-caps; font-size: 20px">What I Do<hr width="50%" style="height: 3px;background-color: #c40000;border: .1px solid red;border-radius: 50%"></div>
	  	<div style="font-family: 'Segoe Print'; font-size:15px"><?php echo $whatdo; ?></div>
  	</td>
  	</tr></table>
  	</center>
</div>

<!-- Third Container (Grid) -->
<div class="container-fluid bg-4 text-center">    
  	<h3 class="margin" id="contact">Where To Find Me?</h3><br>
  	<center>
  	<table border="0" width="90%"><tr>
  	<td width="40%"  style="text-align: center; vertical-align: top;">
	  	<div style="font-variant: small-caps;">Social Networks<hr width="50%" style="height: 3px;background-color: #c40000;border: .1px solid red;border-radius: 50%"></div>
	  	<div style=" font-size:17px"><a href="<?php echo $fb;?>" style="color:#4286f4">Facebook</a></div>
	  	<div style=" font-size:17px"><a href="<?php echo $tweet;?>" style="color:#02d6d6">Twitter</a></div>
	  	<div style=" font-size:17px"><a href="<?php echo $linkedin;?>"  style="color:#02d673">Linkedin</a></div>
	  	<div style=" font-size:17px"><a href="mailto:<?php echo $email;?>" style="color:#fefefe">Email: <?php echo $email;?></a></div>
  	</td>
  	<td width="60%" style="text-align: center; vertical-align: top;">
	  	<div style="font-variant: small-caps;">Send me a Note<hr width="50%" style="height: 3px;background-color: #c40000;border: .1px solid red;border-radius: 50%"></div>
	  	<div style="font-family: 'Segoe Print'; font-size:14px">
	  		<center>
	  		<form class="msg" action="send.php" method="post">
	  			<input type="text" placeholder="Name" maxlength="50" id='msgname' name='msgname' required>
	  			<input type="email" placeholder="Your Email" id='msgemail' name='msgemail' required>
	  			<textarea placeholder="Message" id='msg' name='msg' maxlength="100" style="max-height: 70px;min-height: 70px;" required></textarea>
	  			<input type="hidden" id="msgid" name="msgid" value="<?php echo $id;?>">
	  			<input type="submit" value="Send" style="color:#fefefe;background-color: #4a89ef; font-weight: bold; letter-spacing: 5px;">
	  		</form>
	  	</center>
	  	</div>
  	</td>
  	</tr></table>
  	</center>
</div>

<!-- Footer -->

<footer class="container-fluid bg-3 text-center">
	<?php
	if($id!=1){
	echo "<input type='password' name='qpass' id='qpass' placeholder='Your Password'>
		<form action='delete.php' method='post'>
		<input type='hidden' name='delid' id='delid' value='$id'>
		<input type='hidden' name='delpass' id='delpass' value=''>
		<button type='submit' style='background-color: red;color:#fff' onmouseover='setpdel()'>Delete this Portfolio</button></form>
		<form action='edit.php' method='post'>
		<input type='hidden' name='editid' id='editid' value='$id'>
		<input type='hidden' name='editpass' id='editpass' value=''>
		<button type='submit' style='background-color: #4a89ef;color:#fff' onmouseover='setpedit()'>Edit</button></form><br>";
	}
		?>
  	<p>Developed By <a href="#">NULL POINTER</a></p>
</footer>

<!--New Portfolio-->

<div name='newcontain' id='newcontain' class='lfcontain'>
	<form class='loginform lfanimate' action='new.php' method='post' onsubmit="return validatenew()">
		<div class='imgcontain'>
			<span onclick="document.getElementById('newcontain').style.display='none'" class='close' title='Close'>&times;</span>
			<p style="font-size: 22px; font-variant: small-caps;color:#1a8cff;">Create your Portfolio</p>
		</div>
		<div class='lfcontainer'>
			<center><span id="fillerr" style="display:none;color:red;font-weight: bold;"></span></center>
			<input type="text" name="newname" id="newname" placeholder="Your Fullname" onkeyup="validatename()" maxlength="200" required>
			<input type="text" name="newmotto" id="newmotto" placeholder="Your Motto" maxlength="48" required>
			<input type="email" name="newemail" id='newemail' placeholder="Your Email" onkeyup="validateemail()" required>
			<input type="password" name="newpass" placeholder="New Password" maxlength="100" id="newpass" onkeyup="validatecnfpass()" required>
			<input type="password" name="cnfnewpass" id="cnfnewpass" placeholder="Confirm New Password" onkeyup="validatecnfpass()" required>
			<input type="url" name="newweb" id="newweb" placeholder="Your website or Blog link" maxlength="200">
			<input type="url" name="newfb" id='newfb' placeholder="Your Facebook Profile link or Page link" maxlength="200">
			<input type="url" name="newtweet" id='newtweet' placeholder="Your Twitter Profile link" maxlength="100">
			<input type="url" name="newlinkedin" id='newlinkedin' placeholder="Your Linkedin Profile link" maxlength="100">
			<textarea class="textarea" id="aboutme" name="aboutme" placeholder="About You"  maxlength="500" style="width: 100%; max-height: 100px;min-height: 100px" required></textarea>
			<textarea class="textarea" id="achieve" name="achieve" placeholder="Your Education and Achievements"  maxlength="500" style="width: 100%; max-height: 100px;min-height: 100px;max-width: 100%; min-width: 100%;" required></textarea>
			<textarea class="textarea" id="whatdo" name="whatdo" placeholder="What do you do?"  maxlength="500" style="width: 100%; max-height: 100px;min-height: 100px;max-width: 100%; min-width: 100%;" required></textarea>
			<input type="hidden" id="edit" name="edit" value="new">
			<button type='submit' id='newsubmit'>Create your Portfolio</button>
		</div>
	</form>
</div>


</body>

<script text='text/javascript'>
	function shownew(edit){
		var form=document.getElementById('newcontain');
		form.style.display='block';
	}

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

	function uploaddpform(){
			var form=document.getElementById('dpcontain');
			form.style.display='block';
	}

	function setpdel(){
		var x=document.getElementById('qpass').value;
		document.getElementById('delpass').value=x;
	}

	function setpedit(){
		var x=document.getElementById('qpass').value;
		document.getElementById('editpass').value=x;
	}

</script>
</html>