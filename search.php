<?php
include("db_con.php");


    $conn = connection();
    

    /*
    
    $nome = "plaza";
    $descrizione = "molto ma veramente molto molto bello";
    $posizione = "51.508742,-0.120850";
    $utente = "gianni";

    $sql = "INSERT INTO event(nome, descrizione, posizione, utente)
                VALUES ('$nome','$descrizione','$posizione','$utente')";

   $conn = connection();
    
    $sql = "SELECT posizione FROM event";
   

    $result = $conn->query($sql);

    $rowcount=mysqli_num_rows($result);

     if ($result->num_rows > 0) {
        $row=mysqli_fetch_assoc($result);
     }
*/


?>





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
                
                var startCenter = new google.maps.LatLng(59.508742,-0.120850);
                var mapProp= {center: startCenter ,zoom:15,};
                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                
              var index = <?php echo $rowcount ?>;
              
                for (var i = 0; i < index; i++) {
                    (function(marker) {
                        
                        var pos = new google.maps.LatLng(<?php echo $row[i] ?>);
                        var marker = new google.maps.Marker({
                        position: pos;
                        });
                        marker.setMap(map); 
                    }
                }
                
                
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

