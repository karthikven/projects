<?php

session_start();

require_once('config.php');

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT username FROM neighborhood_social_network.user_registration WHERE username = ? and password = ?";
$stmtselect = $db->prepare($sql);
$result = $stmtselect->execute([$username, $password]);

if ($result) {

	$user = $stmtselect -> fetch(PDO::FETCH_ASSOC);
	if($stmtselect -> rowCount() > 0){
		$_SESSION['userlogin']=$username;
		echo 'Login Successful';
		echo $_SESSION['userlogin'];


	}
	else {
		echo 'Invalid Login Details';
	}
}

else {
	echo "there were errors";
}
