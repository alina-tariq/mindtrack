<?php
session_start();

// if not logged in, sends user back to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- This map.html is the HTML and JS code for the google maps API implementation and geolocation distance calculator-->
<!-- CPS 530 Section 3-4 Group 11 Project-->
    <head>
        <!-- Declare all stylesheets and fonts and other links-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/dashboard.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300&display=swap" rel="stylesheet">

        <!-- In-text css for the google maps -->
        <!-- CSS for the information div when you click on a pin on the map-->
        <style type="text/css">

        #map{
            width: 900px;
            max-width: 100%;
            height: 500px;
            justify-content: center;
            align-content: center;
        }
        #info_div {
            padding-left: 10px;
        }
        </style>
        <title>Find a Clinic</title>
    </head>
<!-- Container class containing the navbar-->
    <body>
        <div class="container">
            <nav class="navbar">
                <div class="nav_icon" onclick="toggleSidebar()">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="navbar__left">
                    <a href="../contact.html">Contact Us</a>
                    <a href="../aboutus.html">About Us</a>
                </div>
                <div class="navbar__right">
                    
                </div>
            </nav>

            <main>
                <!-- div for the content part of the site-->
                <div class="main__container">
                    <div class="main__title">
                        <div class="main__greeting">
                            <h1>Mental Health Clinics Near Ryerson</h1>
                            <h2>Click on the pins for information!</h2>
                        </div>
                    </div>
                    <br><br>
                    <!-- mMain div for the map-->
                    <div class="main__panel">
                        <div class="cardPanel">
                            <div class="card__inner">
                                <!-- divs for the map so we can see it, and the info-->
                                <div id="map"></div>
                                <div id="info_div"></div>
                                <!-- Javascript to implement the map, sourced from https://developers.google.com/maps/documentation/javascript/adding-a-google-map-->
                                <script>
                                function initMap() {

                                    // pick center coordinates for your map
                                    var myMapCenter = {lat: 43.664827, lng: -79.373739};

                                    // create map and say which HTML element it should appear in
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                        center: myMapCenter,
                                        zoom: 14
                                    });
                                    // function for marking the map
                                    function markStore(storeInfo){

                                        var marker = new google.maps.Marker({
                                            map: map,
                                            position: storeInfo.location,
                                            title: storeInfo.name
                                        });

                                        marker.addListener('click', function(){
                                            showStoreInfo(storeInfo);
                                        });
                                    }
                                    // function to show store info
                                    function showStoreInfo(storeInfo){
                                        var info_div = document.getElementById('info_div');
                                        info_div.innerHTML = 'Store name: '
                                            + storeInfo.name
                                            + '<br>Address: ' + storeInfo.Address;
                                    }
                                    // information from the stores, latitude and longitude of clinic locations
                                    var stores = [
                                        {
                                            name: 'Mental Health Outreach Service',
                                            location: {lat: 43.664827, lng: -79.373739},
                                            Address: '410 Sherbourne St #102, Toronto, ON'
                                        },
                                        {
                                            name: 'Mental Health Counselling Toronto',
                                            location: {lat: 43.670157, lng: -79.387137},
                                            Address: '2 Bloor St W #700, Toronto, ON'
                                        },
                                        {
                                            name: 'Mental Health Is Visible',
                                            location: {lat: 43.693340, lng: -79.316110},
                                            Address: '1508-1501 Woodbine Ave, East York, ON M4C 4H1'
                                        }
                                    ];
                                    stores.forEach(function(store){
                                        markStore(store);
                                    });
                                }
                                </script>
                                <!-- google maps API key-->
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaTFCxAAph762D9YnTZ3O-WEfaBXAgQMo&callback=initMap" async defer></script>
                            </div>
                            
                        </div>
                        <!-- div for the second main information panel-->
                        <div class="cardPanel">
                            <!-- Information blocks-->
                                <h3 style="color: white; text-align: left; font-size: 28px;">Information About These Clinics</h3>
                                    <h3 style="color: white; text-align: left; font-size: 20px;">
                                    Mental Health Counselling Toronto
                                </h3>
                                <h2 style="color: white; text-align: left; font-size: 13px;">
                                    Address: 2 Bloor St W #700, Toronto, ON
                                    <br>Hours: Mon-Fri 9am-5pm
                                    <br>Doctor: Anthony Santen SAC Dip(Adv. Psychotherapy) MCH CLC NLP
                                    <br>Approximately 6min drive from Ryerson University, in the heart of Toronto
                                    <br><a href="https://anthonysanten.com/">Click here</a> to visit their website
                                </h2>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 20px;">
                                    Mental Health Outreach Service
                                </h3>
                                <h2 style="color: white; text-align: left; font-size: 13px;">
                                    Address: 410 Sherbourne St #102, Toronto, ON
                                    <br>Hours: Mon-Fri 8:30am-5pm
                                    <br>Local Mental Health Outreach Service, Open to anyone
                                    <br>Approximately 20min drive from Ryerson University, on the west side of Toronto
                                    <br><a href="https://toronto.cmha.ca/">Click here</a> to visit their website
                                </h2>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 20px;">
                                    Mental Health Is Visible
                                </h3>
                                <h2 style="color: white; text-align: left; font-size: 13px;">
                                    Address: 1508-1501 Woodbine Ave, East York, ON M4C 4H1
                                    <br>Hours: Mon-Fri 10am-6pm
                                    <br>Local Mental Health Servie in Toronto
                                    <br>Approximately 20min drive from Ryerson University, on the east side of Toronto
                                    <br><a href="https://mentalhealthvisible.com/?utm_campaign=gmb#about_us">Click here</a> to visit their website
                                </h2>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 20px;">
                                    Centers are closed? Still need support?
                                </h3>
                                <h2 style="color: white; text-align: left; font-size: 13px;">
                                    You can call distress centers of Greater Toronto Area 24/7 at 416-408-4357.
                                    Need emergency help? Call 911.
                                </h2>
                                
                        </div>
                        <!-- div for the third main panel to claculate distance-->
                        <div class="cardPanel">
                            <h3 style="color: white; text-align: left; font-size: 30px;">The Closest Clinics Near You!</h3>
                            <h3 style="color: white; text-align: left; font-size: 20px;">
                                    Find the closest clinic to your address below! (Please allow your browser to access your location)
                                </h3>
                                <!-- info divs-->
                            <div id="info_div1"></div>
                            <div id="info_div2"></div>
                            <div id="info_div3"></div>
                            <!-- javascript for finding users geolocation and calculating distance from geolocation to clinics-->
                            <!-- https://stackoverflow.com/questions/13840516/how-to-find-my-distance-to-a-known-location-in-javascript-->
                            <script type="text/javascript">
                                function distance(lon1, lat1, lon2, lat2) {
                                  var R = 6371; // Radius of the earth in km
                                  var dLat = (lat2-lat1).toRad();  // Javascript functions in radians
                                  var dLon = (lon2-lon1).toRad(); 
                                  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                                          Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) * 
                                          Math.sin(dLon/2) * Math.sin(dLon/2); 
                                  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                                  var d = (R * c)/100; // Distance in km
                                  var f = d.toFixed(2);
                                  return f;
                                }

                                /** Converts numeric degrees to radians */
                                if (typeof(Number.prototype.toRad) === "undefined") {
                                  Number.prototype.toRad = function() {
                                    return this * Math.PI / 180;
                                  }
                                }
                                // Get users geolocation
                                window.navigator.geolocation.getCurrentPosition(function(pos) {
                                  console.log(pos); 
                                  var x = distance(pos.coords.longitude, pos.coords.latitude, -79.373739, 43.664827);
                                  var y = distance(pos.coords.longitude, pos.coords.latitude, -79.387137, 43.670157);
                                  var info_div = document.getElementById('info_div1');
                                        info_div.innerHTML = 'You are ' + distance(pos.coords.longitude, pos.coords.latitude, -79.373739, 43.664827) + 'km away from Mental Health Outreach Service!';
                                  var info_div = document.getElementById('info_div2');
                                        info_div.innerHTML = 'You are ' + distance(pos.coords.longitude, pos.coords.latitude, -79.387137, 43.670157) + 'km away from Mental Health Counselling Toronto!';
                                  var info_div = document.getElementById('info_div3');
                                        info_div.innerHTML = 'You are ' + distance(pos.coords.longitude, pos.coords.latitude, -79.316110, 43.693340) + 'km away from Mental Health Is Visible!';

                                });
                            </script>
                            <h2 style="color: white; text-align: left; font-size: 13px;">
                                    Visit your local clinic today! You can find information about these clinics above.
                                </h2>
                        </div>
                        </a>
                    </div>

                    <br>
                    <br>
                    <br>  
                </div>

            </main>
            <!-- code for sidebar-->
            <div id="sidebar">
                <div class="sidebar__title">
                    <h1>Menu Bar</h1>
                    <i class="fa fa-times" id="sidebarIcon" onclick=closeSidebar()></i>
                </div>
<!-- div for sidebar menu-->
            <div class="sidebar__menu">
                <div class="sidebar__link">
                    <i class="fa fa-home"></i>
                    <a href="dashboard.php">Dashboard</a>
                </div>

                <div class="sidebar__link">
                    <i class="fa fa-bar-chart"></i>
                    <a href="stats.php">Personal Stats</a>
                </div>

                <div class="sidebar__link">
                    <i class="fa fa-files-o"></i>
                    <a href="resource.php">Resources</a>
                </div>

                <div class="sidebar__link active_menu_link">
                    <i class="fa fa-question" style="color: var(--heading-color);"></i>
                    <a href="map.php">Find a Clinic</a>
                </div>

                <br>

                <div class="sidebar__link">
                    <i class="fa fa-user"></i>
                    <a href="account.php">Account</a>
                </div>

                <div class="sidebar__logout">
                    <i class="fa fa-power-off"></i>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        </div>
    </div>
        <script src="../js/dashboard.js"></script>
    </body>
</html>