
<?php
session_start();

    $db_user = "root";
    $db_pass = "";
    $db_name = "neighborhood_social_network";

    $db = mysqli_connect('localhost', 'root', '', 'neighborhood_social_network');
    
    $query = "SELECT * FROM neighborhood_social_network.user_registration WHERE username= '".$_SESSION['userlogin']."'";

    $result = mysqli_query($db,$query);

    $username = "";
    $firstname = "";
    $lastname = "";
    $email = "";
    $phonenumber = "";
    $street = "";
    $building_num = "";
    $zip = "";
    $city = "";
    $state = "";
    $zip = "";
    $intro = "";

    while($row = mysqli_fetch_array($result))
    {
        $username = $row['username'];
        $firstname = $row['user_first_name'];
        $lastname = $row['user_last_name'];
        $email = $row['user_email'];
        $phonenumber = $row['user_phone_number'];
        $street = $row['user_street'];
        $building_num = $row['user_building_number'];
        $zip = $row['user_zip'];
        $city = $row['user_city'];
        $state = $row['user_state'];
        $intro = $row['user_intro'];

    }

    $user_first_name_edit = "";
    $user_last_name_edit = "";
    $user_building_num_edit = "";
    $user_city_edit = "";
    $user_dob_edit = "";
    $user_email_edit = "";
    $user_intro_edit = "";
    $user_state_edit = "";


    if (isset($_POST['update_user_info'])) {
      $user_first_name_edit = mysqli_real_escape_string($db, $_POST['firstname']);
      $user_last_name_edit = mysqli_real_escape_string($db, $_POST['lastname']);
      $user_building_num_edit = mysqli_real_escape_string($db, $_POST['apt']);
      $user_city_edit = mysqli_real_escape_string($db, $_POST['city']);
      $user_intro_edit = mysqli_real_escape_string($db, $_POST['intro']);
      $user_street_edit = mysqli_real_escape_string($db, $_POST['street']);
      $user_state_edit = mysqli_real_escape_string($db, $_POST['state']);
      $user_zip_edit = mysqli_real_escape_string($db, $_POST['zip']);
      $user_phone_number_edit = mysqli_real_escape_string($db, $_POST['mobile']);
      $user_email_edit = mysqli_real_escape_string($db, $_POST['email']);

      //echo $user_first_name_edit;
      $query = "UPDATE neighborhood_social_network.user_registration SET user_first_name = '".$user_first_name_edit."', user_last_name = '".$user_last_name_edit."',user_building_number = '".$user_building_num_edit."', user_street ='".$user_street_edit."',user_state = '".$user_state_edit."', user_city = '".$user_city_edit."',user_zip = '".$user_zip_edit."', user_email = '".$user_email_edit."', user_intro = '".$user_intro_edit."',user_phone_number = '".$user_phone_number_edit."' WHERE username = '".$_SESSION['userlogin']."'";
      mysqli_query($db, $query);
      header('location: feedpage.php');
    }



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Block Talk|Update Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>


<div id="reg_form_wrapper" >

    <h1>Update Profile Information - <?php echo $username;?></h1>
    <br><br>

    <form method="post" action = "edit_profile.php">
    <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="input_container">
        <input placeholder="<?php echo $firstname; ?>" type = "firstname" name = "firstname" id="field_firstname" class='input_field'>
    </div></div>
    <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="input_container">
        <input placeholder="<?php echo $lastname; ?>" type="lastname" name="lastname" id="field_lastname" class='input_field'>
    </div> </div>
    </div>
    <br>
    <div class="input_container">
        <input placeholder="<?php echo $email; ?>" type="email" name="email" id="field_email" class='input_field'>
    </div><br>
  <!--  <div class="input_container">
        <input placeholder="Username" type="username" name="username" id="field_username" class='input_field'>
    </div><br> -->
  <!--  <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="input_container">
                <input placeholder="Password" type="password" name="password" id="field_password" class='input_field'>
            </div></div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="input_container">
                <input placeholder="Re-enter Password" type="renterpassword" name="renterpassword" id="field_renterpassword" class='input_field'>
            </div> </div>
    </ div>
        <br> -->
    <div class="input_container">
        <input placeholder="<?php echo $phonenumber; ?>" type="mobile" name="mobile" id="field_mobile" class='input_field'>
    </div><br>
    <div class="input_container">
        <input placeholder="<?php echo $street; ?>" type="street" name="street" id="field_street" class='input_field'>
    </div><br>

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="input_container">
                <input placeholder="<?php echo $building_num; ?>" type="apt" name="apt" id="field_apt" class='input_field'>
            </div></div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="input_container">
                <input placeholder="<?php echo $zip; ?>" type="zip" name="zip" id="field_zip" class='input_field'>
            </div> </div>
    </div><br>
    <div class="input_container">
        <input placeholder="<?php echo $city; ?>" type="city" name="city" id="field_city" class='input_field'>
    </div><br>
    <div class="input_container">
        <input placeholder="<?php echo $state; ?>" type="state" name="state" id="field_state" class='input_field'>
    </div><br>
    <div class="input_container">
        <input placeholder="<?php echo $intro; ?>" type="text" name="intro" id="intro" class='input_field'>
    </div><br>


    <div class="container custom-margin">
    <div id="map"></div>
    <br>
    <div class="row">
        <div> Click on the map enter your location </div>
        <div id="position" class='input_field'></div>
    </div>
      <script>
      // Initialize and add the map
      var markerLat;
      var markerLong;
      function initMap() {
      // The location of Uluru
      var nyc = {lat: 40.696011, lng: -73.993286};
      // The map, centered at Uluru
      var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 11, center: nyc});
      // The marker, positioned at Uluru
      var marker = new google.maps.Marker({position: nyc, map: map});


      map.addListener('click', function(e) {
      placeMarkerAndPanTo(e.latLng, map, marker);
      });
      }

      function placeMarkerAndPanTo(latLng, map, marker) {

      marker.setPosition(latLng);
      map.panTo(latLng);
      markerLat = marker.getPosition().lat().toFixed(3);
      markerLong = marker.getPosition().lng().toFixed(3);


      document.getElementById('position').innerHTML = '<p>Marker dropped: Current Lat: ' + markerLat + ' Current Lng: ' + markerLong + '</p>';

      $.ajax({
        type:'POST',
        data:{latitude: markerLat, longitude: markerLong},
        url:"edit_profile.php"
      });
      } //end addListener


      </script>
      <!--Load the API from the specified URL
      * The async attribute allows the browser to render the page while the API loads
      * The key parameter will contain your own API key (which is not needed for this tutorial)
      * The callback parameter executes the initMap() function
      -->
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv_oevw-Yngzkiesr9wtYfT5dcwqHxBXI&callback=initMap">
      </script>


      <br><br>

    </div>
      <br><br>

    <input type="submit" value="Update Account" name = "update_user_info" id='update_user_info' class='input_field'>
    <br><br>
    </form>

</div>
</body>

</html>
