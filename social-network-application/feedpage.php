
<?php

    session_start();

     // if (!isset($_SESSION['userlogin'])) {
     //     header("Location: login.php");
     // }


    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION);
        header("Location: login.php");
    }

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

    $block_id = "SELECT block_id FROM user_block_neighborhood_map WHERE username='".$_SESSION['userlogin']."'";
    //
     $result2 = mysqli_query($db,$block_id);
    //echo $result2;
    while($row2 = mysqli_fetch_array($result2)) {
      //echo $row2;
      $a = $row2['block_id'];
      //echo $a;
    }
    $a = '1111';
    $alert_user_name = "SELECT username from user_block_apply WHERE block_id='$a'";
    $result3 = mysqli_query($db,$alert_user_name);
    //echo $result3;
    while($row3 = mysqli_fetch_array($result3)) {
      //echo $row3;
      $username_request = $row3['username'];
    }
    //echo $block_id;

    if(isset($_POST['yes'])){
      echo("You accepted !".$username_request);
      $update_count = "UPDATE neighborhood_social_network.user_block_apply SET approval_count = approval_count+1
WHERE username = '$username_request'";
      $result4 = mysqli_query($db, $update_count);

      while($row4 = mysqli_fetch_array($result4)) {
        echo $row4;
        //username_request = $row4['username'];
      }
    }
    else {
      //$new = 0;
      echo"You rejected". $username_request;
    }

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Block Talk|Feed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="feed.css" rel="stylesheet">
</head>

<body>


<div class="container bootstrap snippets">

    <div class="alert alert-info col-md-12" role="alert">

    <?php echo $username_request; ?> would like to join your block (<?php echo $a; ?>). Would you like to accept?
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
      <input type="submit" name="yes" value="yes"/>

      <input type="button" name="no" value="No"/>
      <!-- <button type="button" class="btn btn-primary">Yes</button>
      <button type="button" class="btn btn-primary">No</button> -->
    </form>

    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel rounded shadow">
                <div class="panel-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-center">
                                <img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="https://static.vecteezy.com/system/resources/previews/000/512/576/non_2x/vector-profile-glyph-black-icon.jpg" alt="John Doe">
                            </li>
                            <li class="text-center">
                                <h4 class="text-capitalize"><?php echo $username; ?></h4>
                                <p class="text-muted text-capitalize"><?php echo $firstname. " ". $lastname; ?></p>
                                <p class="text-muted text-capitalize"><?php echo $phonenumber; ?></p>
                                <p class="text-muted text-capitalize"><?php echo $email;?></p>
                                <p class="text-muted text-capitalize"> <?php echo $street. " ". $building_num;?> <br> <?php echo $city." ". $state;?><br><?php echo $zip;?></p>
                                <p class="text-muted text-capitalize"> <?php echo $intro; ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.panel -->

            <div class="panel panel-theme rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        &emsp;&emsp;&emsp;&emsp;
                    </div>
                    <div>
                        <a href="edit_profile.php" class="btn btn-sm btn-success">Edit</a>
                        <a href="feedpage.php?logout=true" class="btn btn-sm btn-success">Logout</a>
                    </div>
                </div>
               </div>
        </div>


        <div class="col-md-6">
            <div class="panel-header">
                <div class="form-group ">
                    <form class="form-inline mr-auto">
                        <input class="form-control" style="width: 510px" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-mdb-color btn-rounded btn-md my-0 ml-sm-2" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="panel rounded shadow">
                <form action="...">
                    <textarea class="form-control input-lg no-border" rows="2" placeholder="Write something..."></textarea>
                </form>
                <div class="panel-footer">
                    <button class="btn btn-success pull-right mt-5">POST</button>
                    <ul class="nav nav-pills">
                        <li><a href="#"><i class="fa fa-user"></i> Everyone </a></li>
                        <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                    <div class="panel panel-success rounded shadow">
                        <div class="panel-heading no-border">
                            <div class="pull-left half">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="img-circle img-post">
                                        <a href="#" class="media-heading block mb-0 h4 text-white">John Doe</a>
                                        <span class="text-white h6">June 08, 2014</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="text-white h5"><i class="fa fa-thumbs-up"></i> 5</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body no-padding">
                            <div class="inner-all block">
                                <h4>Upload on my album :D</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, iste omnis fugiat porro consequuntur ratione iure error reprehenderit cum est ab similique magnam molestias aperiam voluptatibus quia aliquid! Sed, minima.
                                </p>

                                <img data-no-retina="" src="https://lorempixel.com/340/210/nature/1/" alt="..." width="100">
                                <img data-no-retina="" src="https://lorempixel.com/340/210/nature/2/" alt="..." width="100">
                                <img data-no-retina="" src="https://lorempixel.com/340/210/nature/3/" alt="..." width="100">
                            </div>
                        </div>
                        <div class="panel-footer no-padding no-border">
                            <div class="media inner-all no-margin">
                                <div class="pull-left">
                                    <img style="width:25px;height:25px;" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="..." class="img-post2">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="h5">John Doe</a>
                                    <small class="block text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </small>
                                    <small class="text-xs text-muted"><i>Dec 08, 2014</i></small>
                                </div>
                            </div>
                            <div class="line no-margin"></div>
                            <div class="media inner-all no-margin">
                                <div class="pull-left">
                                    <img style="width:25px;height:25px;" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="h5">John Doe</a>
                                    <small class="block text-muted">Quaerat, impedit minus non commodi facere doloribus nemo ea voluptate nesciunt deleniti.</small>
                                    <small class="text-xs text-muted"><i>Dec 08, 2014</i></small>
                                </div>
                            </div>
                            <div class="line no-margin"></div>
                            <form action="#" class="form-horizontal inner-all">
                                <div class="form-group has-feedback no-margin">
                                    <input class="form-control" type="text" placeholder="Your comment here...">
                                    <button type="submit" class="btn btn-theme fa fa-search form-control-feedback"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success rounded shadow">
                  <div class="panel-heading no-border">
                      <div class="pull-left half">
                          <div class="media">
                              <div class="media-object pull-left">
                                  <span class="text-white h3">Click on marker to read message</span>
                              </div>
                          </div>
                      </div>
                      <br>
                      <div class="clearfix"></div>
                      <br>

                      <div id="map" style="position: relative;overflow: hidden;width: 500px;height: 500px"></div>

                      <script>

                       let markers = [{ id: 1000000003, lat:	-73.97,	lng: 40.69, content: 'Hi, please reply to this thread to make a list of'},
                       { id:1000000002, lat:		-73.97,	lng: 	40.69, content:	'Hello, please reply to this thread to record your ...	'},
                       { id:1000000001, lat:	-73.97,	lng: 	40.69, content:	'Hi, please reply to this thread to make a list of ...'}];

                      // Initialize and add the map

                      var markerLat;
                      var markerLong;
                      function initMap() {
                        // The location of Uluru
                        // var nyc = {lat: 40.696011, lng: -73.993286};
                        // // The map, centered at Uluru
                        // var map = new google.maps.Map(
                        //   document.getElementById('map'), {zoom: 11});
                        // // The marker, positioned at Uluru
                        //
                        // for (var i = 0; i < markers.length-1; i++) {
                        //   console.log('here' + markers.length)
                        //   var position = {lat: markers[i].lat, lng: markers[i].lng}
                        //   var myLatlng = new google.maps.LatLng(40.6 , -73.9);
                        //   marker = new google.maps.Marker({position: myLatlng, map: map});
                        //   var infowindow = new google.maps.InfoWindow({
                        //     content: markers[i].content
                        //   });
                        //   marker.setPosition(myLatlng);
                        //   map.panTo(myLatlng);
                        //   google.maps.event.addListener(marker, 'click', function() {
                        //    infowindow.setContent('test: ');
                        //    infowindow.open(map, this);
                        //   });
                        //
                        //
                        //
                        //
                        //   // map.addListener('click', function(e) {
                        //   // //placeMarkerAndPanTo(e.latLng, map, marker);
                        //   // });
                        // }
                        var locations = [
                           ['1001', 40.97, -73.69, 'Hi, please reply to this thread to make a list of'],
                           ['1002', 40.83036, -72.99, 'Hello, please reply to this thread to record your ...	'],
                           ['1001', 40.328249, -73.69, 'Hi, please reply to this thread to make a list of ...']
                         ];

                        var map = new google.maps.Map(document.getElementById('map'), {
                          zoom: 8,
                          center: new google.maps.LatLng(40.92, -73.25),
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                        var infowindow = new google.maps.InfoWindow();

                        var marker, i;

                        for (i = 0; i < locations.length; i++) {
                          marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map
                          });

                          google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                              infowindow.setContent(locations[i][3]);
                              infowindow.open(map, marker);
                            }
                          })(marker, i));
                        }
                      }

                      function placeMarkerAndPanTo(latLng, map, marker) {

                      marker.setPosition(latLng);
                      map.panTo(latLng);
                      markerLat = marker.getPosition().lat().toFixed(3);
                      markerLong = marker.getPosition().lng().toFixed(3);


                      //document.getElementById('position').innerHTML = '<p>Marker dropped: Current Lat: ' + markerLat + ' Current Lng: ' + markerLong + '</p>';

                      $.ajax({
                        type:'POST',
                        data:{latitude: markerLat, longitude: markerLong},
                        url:"server.php"
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
                      <br>
                      </div>

                </div>
            </div>


        <div class="col-md-3">
            <div class="panel panel-success rounded shadow">
                <div class="panel-heading no-border">
                    <div class="pull-left half">
                        <div class="media">
                            <div class="media-object pull-left">
                                <span class="text-white h3">Friends</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-footer no-padding no-border">
                    <div class="line no-margin"></div>
                    <div class="media inner-all no-margin">
                        <div class="pull-left">
                            <img style="width:25px;height:25px;" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">
                        </div>
                        <div class="media-body">
                            <div class="h5">John Doe</div>
                        </div>
                    </div>
                    <div class="line no-margin"></div>
                </div>
            </div>





            <div class="panel panel-success rounded shadow">
                <div class="panel-heading no-border">
                    <div class="pull-left half">
                        <div class="media">
                            <div class="media-object pull-left">
                                <span class="text-white h3">Neighbours</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-footer no-padding no-border">
                    <div class="line no-margin"></div>
                    <div class="media inner-all no-margin">
                        <div class="pull-left">
                            <img style="width:25px;height:25px;" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">                        </div>
                        <div class="media-body">
                            <div class="h5">John Doe</div>
                        </div>

                        <div class="pull-left">
                            <img style="width:25px;height:25px;" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">                        </div>
                        <div class="media-body">
                            <div class="h5">John Doe</div>
                        </div>

                    </div>
                    <div class="line no-margin"></div>
                </div>
            </div>

            <div class="panel panel-success rounded shadow">
                <div class="panel-heading no-border">
                    <div class="pull-left half">
                        <div class="media">
                            <div class="media-object pull-left">
                                <span class="text-white h3">Friend Requests</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-footer no-padding no-border">
                    <div class="line no-margin"></div>
                    <div class="media inner-all no-margin">
                        <div class="pull-left">
                            <img style="width:25px;height:25px;" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">                        </div>
                        <div class="media-body">
                            <div class="h5">John Doe</div>
                            <button class="btn btn-sm fa fa-check btn-success"></button>
                            <button class="btn btn-sm fa fa-times btn-danger"></button>
                        </div>


                    </div>
                    <div class="line no-margin"></div>
                </div>
            </div>


            <div class="panel panel-success rounded shadow">
                <div class="panel-heading no-border">
                    <div class="pull-left half">
                        <div class="media">
                            <div class="media-object pull-left">
                                <span class="text-white h3">Block Requests</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-footer no-padding no-border">
                    <div class="line no-margin"></div>
                    <div class="media inner-all no-margin">
                        <div class="pull-left">
                            <img style="width:25px;height:25px;" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">                        </div>
                        <div class="media-body">
                            <div class="h5">John Doe</div>
                            <button class="btn btn-sm fa fa-check btn-success"></button>
                            <button class="btn btn-sm fa fa-times btn-danger"></button>
                        </div>


                    </div>
                    <div class="line no-margin"></div>
                </div>
            </div>

        </div>
        </div>
    </div>

</body>
</html>
