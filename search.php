<?php
include("db_con.php");


    $conn = connection();
    

   /* 
    
    $nome = "plaza";
    $descrizione = "molto ma veramente molto molto bello";
    $lat = "55.508742";
    $long = "-8.120850";
    $utente = "gianni";

    $sql = "INSERT INTO event(nome,descrizione,latitudine,longitudine,username)
                VALUES ('$nome','$descrizione','$lat','$long','$utente')";


    if ($conn->query($sql) == TRUE) {
                header('Location: login.php');

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

   /*$conn = connection();
    */
    $sql = "SELECT latitudine, longitudine FROM event";
   


    $result = $conn->query($sql);

    $rowcount=mysqli_num_rows($result);
   // $row=mysqli_fetch_assoc($result);
  
    echo $rowcount;
$la;
$lo;
    
   if ($result->num_rows > 0) {
         while($rowcount>0){
             
             $row[$rowcount] = mysqli_fetch_assoc($result);
             $rowcount = $rowcount - 1;
             
             echo "sono qui";
         }
   }

        
         
         foreach ($row as $cord)
{
             
     $la = $cord['latitudine'];  
    $lo = $cord['longitudine'];
             
    echo 'Titolo film: ' , $cord['latitudine'];
    echo '<br>';
    echo 'Anno: ' , $cord['longitudine'];
}
         
        //row=mysqli_fetch_assoc($result);
        
        /* echo $row["longitudine"];
         $row=mysqli_fetch_assoc($result);
         echo $row["latitudine"];
         echo $row["longitudine"];
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
                
                var startCenter = new google.maps.LatLng(51.508742,-0.120850);
                var mapProp= {center: startCenter ,zoom:4,};
                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
              
                
                /*    function(marker) {          
                        
                        var pos = new google.maps.LatLng(59.508742,-0.120850);
                        var marker = new google.maps.Marker({
                        position: pos;
                        
                        });
                        marker.setMap(map);
                        
                    }
                
                
                for(){
                    var startCenter = new google.maps.LatLng(51.508742,-0.120850);
                    var marker = new google.maps.Marker({position:startCenter});
                    marker.setMap(map);
                    
                }
                
                */
                var marker = new google.maps.Marker({position:startCenter});
                marker.setMap(map);     
                
                /*
                var infowindow = new google.maps.InfoWindow({content: "ciao!"});
                infowindow.open(map,marker);
                */
                
                google.maps.event.addListener(marker, 'click', function() {
                var newCenter = new google.maps.LatLng(<?php echo $cord['latitudine'] ?>,<?php echo $lo ?>);
                marker.setPosition(newCenter);
                
                marker.setAnimation(google.maps.Animation.BOUNCE);
                var x = "rusco sei un babbucchione";
                document.getElementById("dataEvent").innerHTML =x;
                });
                 
            }
            
        </script>
        
    
        
        
        
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
        
    
    </body>
    
    
</html>

