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
    $sql = "SELECT * FROM event";
   


    $result = $conn->query($sql);

    $rowcount=mysqli_num_rows($result);
   // $row=mysqli_fetch_assoc($result);
  
      
    $la;
    $lo;
    
    if ($result->num_rows > 0) {
         while($rowcount>0){
             
             $row[$rowcount] = mysqli_fetch_assoc($result);
             $rowcount = $rowcount - 1;
             
         }
   }

        $i = 0;
        $array[rowcount][5];
         
         foreach ($row as $cord){
             
            $array[$i][0] =  $cord['nome']; 
            $array[$i][1] =  $cord['descrizione'];
            $array[$i][2] =  $cord['latitudine'];
            $array[$i][3] =  $cord['longitudine'];
            $array[$i][4] =  $cord['user'];
             
           // $la = $cord['latitudine'];  
            //$lo = $cord['longitudine'];
            //$descr = $cord['descrizione'];
            //$nomi[$i] = $cord['nome'];
            //$user = $cord['user'];
            $i = $i + 1;
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
                
                <div id= "nome">Seleziona un Evento...</div>
                <div id= "descrizione"></div>
                <div id="segnalazione"><a href="profile.php" id= "segnUser" ></a></div>
                
                
            </li>
            
        </ul>    
         
        <script>
            function myMap() {
                
                
                  
                
                        
                            var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                            var mapProp= {center: startCenter ,zoom:11,};
                            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                
                
                
                
             /*   
                
                if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                                map.setCenter(pos);
                        });
                }
                
    */            
                
                
                
                
                
                
                
                
                
                
                
                           /*  if (navigator.geolocation) {
                
                                alert('aono qui');
                                navigator.geolocation.getCurrentPosition(function(get_position);
                                alert('aono qui2');
                
                                }
                            else{
                
                                alert('La geo-localizzazione NON è possibile');
                                }            
                
                
                
                            function get_position(position){
                                
                                alert('aono qui9');
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;
 
                                var miaPosizione = new google.maps.LatLng(latitude,longitude);
                                alert('aono qui');
                            
                                var marker = new google.maps.Marker({position: miaPosizione});
                                marker.setMap(map); 
                                

                

                            }
    
              
                
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
                
            
            
            
           
            
            
            
            
            
                
                var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                
                var marker = new google.maps.Marker({position:startCenter});
                marker.setMap(map); 
                
                var nome = "<?php echo $array[0][0] ?>";
                var descrizione = "<?php echo $array[0][1] ?>";
                var coordinate = "<?php echo $array[0][2] ?> , <?php echo $array[0][3] ?>";
                var segnalatoDa =  "segnalato da: <?php echo $array[0][4] ?>";
               
                
                
                
                google.maps.event.addListener(marker, 'click', function() {
                    
                   // var newCenter = new google.maps.LatLng(<?php echo $cord['latitudine'] ?>,<?php echo $lo ?>);
                    //marker.setPosition(newCenter);
                
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    document.getElementById("nome").innerHTML =nome;
                    document.getElementById("descrizione").innerHTML =descrizione;
                    document.getElementById("segnUser").innerHTML =segnalatoDa;
                });
                 
        }
            
        </script>
        
    
        
        
        
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
        
    
    </body>
    
    
</html>

