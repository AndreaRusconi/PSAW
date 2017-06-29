


<?php

session_start();
include("db_con.php");



if(!isset($_SESSION['username'])){
    
    header ("location:login.php");
}



    

   
    if(isset($_POST['submit'])) {   
    
        $nomeEvento = $_POST['nome'];
        $descrizione = $_POST['descrizione'];
        $username = $_SESSION['username'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];
   //controlla bene     
        if(empty($nomeEvento)){
            echo 'impossibile salvare evento';
            header('Location: share.php');
            
        }

  
    $conn = connection();

  
        
        
    $stmt = $conn->prepare("INSERT INTO event (nome,descrizione,latitudine,longitudine,user) VALUES(?,?,?,?,?)");
            $stmt->bind_param("ssdds", $nomeEvento,$descrizione,$lat,$long,$username);
            $stmt->execute();
            $stmt->close();    
        
        header('Location: search.php');

    
    }




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/share.css" />
    <title>share</title>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js" ></script>
        <script src="js_eventcreate.js"></script>
        <script src="external-js/jonthornton-jquery-timepicker-e417a53/jquery.timepicker.min.js"></script>
        <link rel="stylesheet" href="external-js/jonthornton-jquery-timepicker-e417a53/jquery.timepicker.css">
        <style>
            input {
                vertical-align: middle;
                height: 30px;
            }
        </style>
</head>
    
    
    <script>
            $('document').ready(function () {
                $( "#dataE" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    minDate: new Date()
                });
                $('#timeE').timepicker({
                    timeFormat: "H:i"
                });
            });
        </script>
    
    
    
    
    <body>
        
    <ul id="menu">
        <li class="other"><a href="logout.php">logout</a></li>
        <li class="other"><a href="generalProfile.php?var=<?php echo $_SESSION['username'] ?>" > <?php echo $_SESSION['username'] ?> </a></li>
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
                
                <h1 id= "tit">Drag the marker..</h1>
               <div class="labels">
                    <label id ="descNome" for="nome">Nome evento:</label>
                    <input id="nome" name="nome" type="text" required="required" aria-required="true" autocomplete="off"  placeholder="">
                </div>
                
               
                
                <div class="labels">
                    <label id ="descLabel" for="descrizione">Inserisci qui una descrizione dell'evento:</label>
                    <textarea id="descrizione" name="descrizione" required="required" autocomplete="off" ></textarea>
                </div>
                
                
                <ul id="quando">
                    <li id="giorno">Giorno: <input type="datetime" name="dateE" id="dataE"></li>
                    <li id = "ora">Ore: <input type="time" name="timeE" id="timeE"></li>
                </ul>
                <div class="labels">
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