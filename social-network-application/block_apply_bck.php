
<?php
	
	//session_start();
	//$uname = $_SESSION['username'];

	$db = mysqli_connect('localhost', 'root', '', 'neighborhood_social_network');

	//$uname = mysqli_real_escape_string($db, $_SESSION['username']);

	$uname = $_POST['uname'];


	


	if (isset(($_POST["latitude"])))
	{


				$db = mysqli_connect('localhost', 'root', '', 'neighborhood_social_network');

				
				echo $uname;

				$block = "";
				//echo $uname;
				
				$lat = floatval($_POST["latitude"]);
				$lng = floatval($_POST["longitude"]);

				$sql = "UPDATE neighborhood_social_network.user_registration SET user_latitude = ".$lat." WHERE username ='".$uname."'";//.$username."'";		
				$result = mysqli_query($db, $sql);

				echo $lat;
				echo $lng;
	
}






