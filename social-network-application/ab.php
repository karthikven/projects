<?php
//$db = mysqli_connect('localhost', 'root', '', 'neighborhood_social_network');
session_start();

//require_once('config.php');

$db = mysqli_connect('localhost', 'root', '', 'neighborhood_social_network');

if (isset(($_POST["latitude"])))
{
	$lat = floatval($_POST["latitude"]);
	$lng = floatval($_POST["longitude"]);

	$sql = "UPDATE neighborhood_social_network.user_registration SET user_longitude = ".$lat." WHERE username = 'john_doe'";
	$result = mysqli_query($db, $sql);

	echo $lat;
	echo $lng;
	
}



/*
if (!empty($_POST['latitude'])) {
  echo 'hello';
  echo $_POST['latitude'];
}



$a = $_POST['latitude'];
if($_GET) {
  echo 'ad';
}


//$b = $_POST['longitude'];


echo $a;
//echo $b;

/*

$sql = "UPDATE user_registration SET user_longitude = '22.3' WHERE username = 'ironman'";
//$stmtselect = $db->prepare($sql);
//$result = $stmtselect->execute(['alan_tur', 'pass']);
$result = mysqli_query($db, $sql);

if ($result) {

	$user = $stmtselect -> fetch(PDO::FETCH_ASSOC);
	if($stmtselect -> rowCount() > 0) {
		$_SESSION['userlogin']=$user;
    //echo $user;
		echo 'Login Successful';

		//echo mysqli_fetch_assoc($result);
	}
	else {
		echo 'Invalid Login Details';
	}
}

else {
	echo "there were errors";
}

*/

?>
