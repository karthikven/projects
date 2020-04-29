<?php session_start();?>

<?php include('block_apply_bck.php') ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Block Talk|Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>



<div id="reg_form_wrapper" >

    <h1>Block Apply</h1>
    <br><br>

    <form method="post" action = "block_apply.php">
        
    <div class="container custom-margin">
    <div id="map"></div>
    <br>
    <div class="row">
        <div> Click on the map enter your location </div>
        <div id="position" class='input_field'></div>
        <input type="button" id="map_update" width="100px" value="Update" />
    </div>
    <div> <br> The block assigned is: <?php echo $block; ?>. Click Apply to become a member </div>
     
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


        document.getElementById('position').innerHTML = markerLat + ', ' + markerLong;


       $.ajax({
         type:'POST',
         data:{latitude: markerLat, longitude: markerLong},
         url:"server.php"
       });
      } //end addListener

     </script> 



      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv_oevw-Yngzkiesr9wtYfT5dcwqHxBXI&callback=initMap">
      </script>

      <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>




      <br><br>

    </div> 
      <br><br>


      <script>

      $(function(){
          $('#map_update').click(function(e){
            let position = document.getElementById('position').innerHTML;
            let latlong = position.split(',');

            //let password = $('#password').val();
            //alert(latlong[0]);
            //alert(latlong[1]);

          $.ajax({
              type: 'POST',
              url: 'block_apply_bck.php',
              data: ({uname:<?php echo $_SESSION['username']; ?>, latitude: latlong[0], longitude: latlong[1]}),
              success: function(data) {

                //let password = $('#password').val();
                //alert(latlong[0]);
                //setTimeout('window.location.href = "server.php"',1000);
                  //alert(data);

              },
              error: function(data){
                  alert("There are new errors");
              }
          });

          // $.get('ab.php', { a: 'a' }, function() {
          //   setTimeout('window.location.href = "ab.php"',1000);
          //   alert('yay');
          // });

        });
      });


      </script>     



    <input type="submit" value="Apply" name = "block_apply" id='block_apply' class='input_field'>
    <br><br>
    </form>

</div>
</body>

</html>
