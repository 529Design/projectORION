<!DOCTYPE html >
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Event App</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */

        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;

            
        }
    </style>
</head>

<body>
    <!--PUT NAV HERE-->
    test
    <div id="map"></div>



    <script>
        var customLabel = {
            default: {
                label: ' '
            }
        };




        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                //center: new google.maps.LatLng(42.886447, -78.878369),
                center: new google.maps.LatLng(<?php echo(json_encode($lat))?>, <?php echo(json_encode($lon))?>),
                zoom: 12
            });
            var infoWindow = new google.maps.InfoWindow;

            // Change this depending on the name of your PHP or XML file
            downloadUrl('xmlmaker.php', function(data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var id = markerElem.getAttribute('eventID');
                    var name = markerElem.getAttribute('eventTitle');
                    var address = markerElem.getAttribute('eventLocation');
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('eventLatitude')),
                        parseFloat(markerElem.getAttribute('eventLongitude')));
                    var time = markerElem.getAttribute('eventTime');
                    var url = markerElem.getAttribute('eventLink');
                    var infowincontent = document.createElement('div');

                    var link = document.createElement('a');
                    link.href = url;
                    link.target = '_blank';
                    link.textContent = name + "  " + time;
                    infowincontent.appendChild(link);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    //Customize marker data after title here
                    var icon = customLabel[type] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        label: icon.label
                    });
                    marker.addListener('click', function() {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                    marker.addListener('mouseover', function() {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                    //This will open the event link by clicking the marker
                    //Dont know if i want this functionality b.c mobile & desktop variability
                    //google.maps.event.addListener(marker, 'click', function() {
                    //    window.open(link.href);
                    //});
                });
            });
        }



        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing() {}
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGMx3U3qcwgWyp4yurJ1MMCrwWOBanNHg&callback=initMap">
    </script>
</body>

</html>