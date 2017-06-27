


<?php

session_start();
include("db_con.php");



if(!isset($_SESSION['username'])){
    
   // $message = "devi effettuare il login per poter accedere alla pagina";
   //echo "<script type='text/javascript'>alert('$message');</script>";
    header ("location:login.php");
}



    

   
    if(isset($_POST['submit'])) {   
    
        $nomeEvento = $_POST['nome'];
        $descrizione = $_POST['descrizione'];
        $username = $_SESSION['username'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];

  
    $conn = connection();

    $sql = "INSERT INTO event(nome,descrizione,latitudine,longitudine,user)
                VALUES ('$nomeEvento','$descrizione','$lat','$long','$username')";


    if ($conn->query($sql) == TRUE) {
        header('Location: search.php');

    }
    else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/share.css" />
    <title>share</title>
</head>
    
    
    
    
    <body>
        
    <ul id="menu">
        <li class="other"><a href="logout.php">logout</a></li>
        <li class="other"><a href="generalProfile.php?gianni=<?php echo $_SESSION['username'] ?>" > <?php echo $_SESSION['username'] ?> </a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>  
    
        
            
        <ul id="box">
            <li id="googleMap">
            </li>
        <form method="post" class="menu" name="event" autocomplete="off" novalidate="">
        
            <li id="dataEvent">
                
                <div id= "tit">Drag the marker..</div>
                <input id="nome" name="nome" type="text" required="required" aria-required="true" value=""  placeholder="Nome Evento">
                <textarea id="descrizione" name="descrizione" rows="10" cols="30">Inserisci qui una descrizione dell'evento</textarea>
                
                <div class="rememberMe">
                    <input type="checkbox" id="remBox" name="remember_me" onclick="unlock(this)" checked >
                    <label id="remLabel" for="remBox">Utilizza la geolocalizzazione</label>
                </div>
                
              
                
                
                <ul id="pos">
                    <li>
                        <input id="lat" name="lat" type="text" required="required" aria-required="true" value=""  placeholder="latitudine">
               
                    </li>
                
                    <li>
                         <input id="long" name="long" type="text" required="required" aria-required="true" value=""  placeholder="longitudine">
                    </li>
                </ul>
                
                
                
                <input id="accesso" name="submit" type="submit" value="Share">
            </li>
             </form>
            
        </ul> 
        
       
        
        <script>
            
            var x;
            var y;
                  
                
               
                                                       

                    if (navigator.geolocation) {
                
                                navigator.geolocation.getCurrentPosition(function(position) {
                                                                                           
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    
                                    
                                    x = pos.lat;
                                    y = pos.lng;
                                    
                                    
                                    document.getElementById("lat").value = x;
                                    document.getElementById("long").value = y;
                                    
                                     
                                });
                            }
                            
                    else{
                            alert('La geo-localizzazione NON è possibile');
                        }  
               
               
          
            
            
                    
                    function unlock(check) {
                            if(check.checked) {
			                         document.getElementById("lat").value = x;
                                     document.getElementById("long").value = y;
		                    }
                            else { 
                                
                                     document.getElementById("lat").value = "";
                                     document.getElementById("long").value = "";
		                      }                    
                    }

            
            
           
            
            
        
         function myMap() {
                
                
                  
                           
                        
                            var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                            var mapProp= {center: startCenter ,zoom:13,mapTypeControl: true,navigationControl: true,};
                            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                
                            if (navigator.geolocation) {
                
                                
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    map.setCenter(pos);
                                    
                                    var marker = new google.maps.Marker({
                                        position: pos,
                                        map: map,
                                        draggable:true,
                                        title:"Drag me!"
                                       
                                    });
                                     google.maps.event.addListener(marker, 'dragend', function() {
                                        
                                            
                                           var xNew = marker.getPosition().lat();
                                           var yNew = marker.getPosition().lng();   
                                         
                                            document.getElementById("lat").value = xNew;
                                            document.getElementById("long").value = yNew; 
                                            document.getElementById("remBox").checked = false;
                                         
                                          });
  
                                    
                                    
                                });
                                    
                                        
                                
                            }
                            
                            else{
                                alert('La geo-localizzazione NON è possibile');
                                }  
                    
        
         }
        </script>
    
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
        
    </body>
    
    
    
    
</html>