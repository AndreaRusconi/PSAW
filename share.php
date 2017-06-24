


<?php
/*
session_start();
include("db_con.php");



if(!isset($_SESSION['username'])){
    <script>alert('devi effettuare l accesso');</script>
  header ("location:login.php");
}



   
    $flag = false;
    $remember = $_POST['remember_me'];

    if ($remember) {
            $flag = true;
    }
    

   
    if(isset($_POST['submit'])) {   
    
        $nomeEvento = $_POST['nome'];
        $descrizione = $_POST['descrizione'];
        $username = $_SESSION['username'];
        $lat = $_POST['lat'];
        $lat = $_POST['long'];

  
    $conn = connection();

    $sql = "INSERT INTO event(nome,descrizione,latitudine,longitudine,username)
                VALUES ('$nomeEvento','$descrizione','$lat','$long','$username')";


    if ($conn->query($sql) == TRUE) {
         <script>alert('evento condiviso con successo');</script>
                header('Location: share.php');

    }
    else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


*/

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/share.css" />
    <title>share</title>
</head>
    
    
    
    
    <body>
    
    <h1>share</h1>
   
        
        
        
            
        <ul id="box">
            <li id="googleMap">
            </li>
        <form method="post" class="menu" name="event" autocomplete="off" novalidate="">
        
            <li id="dataEvent">
                
                <div id= "tit">Seleziona un punto sulla mappa...</div>
                <input id="nome" name="nome" type="text" required="required" aria-required="true" value=""  placeholder="Nome Evento">
                <textarea id="descrizione" name="descrizione" rows="10" cols="30">Inserisci qui una descrizione dell'evento</textarea>
                
                <div class="rememberMe">
                    <input type="checkbox" id="remBox" name="remember_me" unchecked>
                    <label id="remLabel" for="remBox">Utilizza la geolocalizzazione</label>
                </div>
                
              
                
                
                <ul id="pos">
                    <li>
                        <input id="lat" name="nome" type="text" required="required" aria-required="true" value=""  placeholder="latitudine">
               
                    </li>
                
                    <li>
                         <input id="long" name="nome" type="text" required="required" aria-required="true" value=""  placeholder="longitudine">
                    </li>
                </ul>
                
                
                
                <input id="accesso" name="submit" type="submit" value="Share">
            </li>
             </form>
            
        </ul> 
        
       
        
        <script>
            
           var ciccio = true;
                  
                
               if(ciccio){  
                                                       

                    if (navigator.geolocation) {
                
                                                                                       

                                navigator.geolocation.getCurrentPosition(function(position) {
                                                                                           

                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    
                                    
                                    var x = pos.lat;
                                    var y = pos.lng;
                                    
                                    document.getElementById("lat").value = x;
                                    document.getElementById("long").value = y; 
                                });
                            }
                            
                            else{
                                alert('La geo-localizzazione NON è possibile');
                                }  
               
               }
            else{
                
                
                
            }
            
            
           
            
            
        
         function myMap() {
                
                
                  
                           
                        
                            var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                            var mapProp= {center: startCenter ,zoom:11,};
                            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                
                            if (navigator.geolocation) {
                
                                
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    map.setCenter(pos);  
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