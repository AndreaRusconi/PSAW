<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/search.css" />
    <title>search</title>
</head>
    
    
     
    
    <body>
    <h1>search</h1>
    
        <ul id="box">
            <li id="googleMap">
            </li>
        
        
            <li id="dataEvent">
            </li>
            
        </ul>    
         
        <script>
            function myMap() {
                
                var startCenter = new google.maps.LatLng(51.508742,-0.120850);
                var mapProp= {center: startCenter ,zoom:5,};
                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                
                
                
                var marker = new google.maps.Marker({position:startCenter});
                marker.setMap(map);     
                
                /*
                var infowindow = new google.maps.InfoWindow({content: "ciao!"});
                infowindow.open(map,marker);
                */
                
                google.maps.event.addListener(marker, 'click', function() {
               /* var newCenter = new google.maps.LatLng(48.508742,-0.120850);
                marker.setPosition(newCenter);
                */
                marker.setAnimation(google.maps.Animation.BOUNCE);
                var x = "rusco sei un babbucchione";
                document.getElementById("dataEvent").innerHTML =x;
                });
                 
            }
        </script>
        
    
        
        
        
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
        
    
    </body>
    
    
</html>

