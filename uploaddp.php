
<?php

$servername = "localhost";
$username = "root";
$password = "akk";
$dbname = "portfolio";
$pass=$_POST["uploadpass"];
$id=$_POST["dpid"];

$conn=mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    echo "<script>alert('Sorry Cannot Connect to server');window.location='index.php?id=$id'</script>";
    die();
}


$sql="SELECT password FROM users WHERE id=$id";
$result=mysqli_query($conn,$sql);
if(!$result){
    echo "<script>alert('Sorry Cannot Connect to server');window.location='index.php?id=$id'</script>";
    die();
}

$row=mysqli_fetch_assoc($result);
if($pass!==$row["password"]){
    echo "<script type='text/javascript'>alert('Wrong Password');window.location='index.php?id=$id';</script>";
    die();
}




$target_dir = "dps/";
$target_file = $target_dir . basename($_FILES["dp"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["dp"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk=0;
        die();
    }
}
// Check if file already exists

// Check file size
if ($_FILES["dp"]["size"] > 600000) {
    echo "<script type='text/javascript'>alert('Sorry, Your image is too large(only upto 600 KB is allowed)');window.location='index.php'</script>";
    $uploadOk=0;
    die();
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    "<script type='text/javascript'>alert('Sorry, Only png, jpg and jpeg files are allowed');window.location='index.php'</script>";
    $uploadOk=0;
    die();
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script type='text/javascript'>alert('Sorry, your image not uploaded');window.location='index.php'</script>";
    die();
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
        rename($target_file,"dps/dp$id.jpg");

		$sql="UPDATE users SET dp=1 WHERE id=$id" ;
		$result=mysqli_query($conn,$sql);
		if(!$result){
			echo "<script type='text/javascript'>alert('Sorry, your image not uploaded');window.location='index.php'</script>";
			die();
		}
        echo "<script type='text/javascript'>window.location='index.php?id=$id';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Sorry, your image not uploaded');window.location='index.php'</script>";
        die();
    }
}
?>
