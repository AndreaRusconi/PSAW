<?php
session_start();
    if(isset($_SESSION['username'])){
        $ok = true;
    }
 
include("db_con.php");


    $conn = connection();

    $sql = "SELECT * FROM event";
   
    $result = $conn->query($sql);

    $rowcount=mysqli_num_rows($result);
  
    $tot = $rowcount;
    
    if ($result->num_rows > 0) {
         while($rowcount>0){
             
             $row[$rowcount] = mysqli_fetch_assoc($result);
             $rowcount = $rowcount - 1;
             
         }
   }

        $i = 0;
        $array[$tot][5];
         
         foreach ($row as $cord){
             
            $array[$i][0] =  $cord['nome']; 
            $array[$i][1] =  $cord['descrizione'];
            $array[$i][2] =  $cord['latitudine'];
            $array[$i][3] =  $cord['longitudine'];
            $array[$i][4] =  $cord['user'];
            $array[$i][5] =  $cord['immagine'];

            $i = $i + 1;
         }


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/search.css" />
    <title>search</title>
</head>
    
    
     
    
    <body>
        
    <ul id="menu">
        
        <li class="other"><a href="<?php if($ok){echo "logout";} else{echo "login";} ?>.php"><?php if($ok){echo "logout";} else{echo "login";} ?></a></li>
        <li class="other"><a href="<?php if($ok){echo "Generalprofile";} else{echo "registration";} ?>.php?gianni=<?php echo $_SESSION['username'] ?>"><?php if($ok){echo $_SESSION['username'];} else{echo 'sign up';} ?></a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>    
        
        
        
   
    
        <ul id="box">
            <li id="googleMap">
            </li>
        
        
            <li id="dataEvent">
                
                <div id= "nome">Seleziona un Evento...</div>
                <div id= "descrizione"></div>
                <div id='segnalazione'><a id= 'segnUser'></a></div>
                
               
                
                
            </li>
            
        </ul>    
         
        <script>
            function myMap() {
                
                
                  
                           
                        
                            var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                            var mapProp= {center: startCenter ,zoom:11,};
                            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                
                            if (navigator.geolocation) {
                
                                console.log(navigator.geolocation);
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
                
                            
                            dati = new Array();
                        
                            var j = 0;
            
                            <?php $index=0;
                                while ($index < $tot) {
                            ?>  
                                
                                var posMarker = new google.maps.LatLng(<?php echo $array[$index][2] ?>,<?php echo $array[$index][3] ?>);
                                posTemp = new google.maps.Marker({position:posMarker});
                                    
                               
                               
                                posTemp.setMap(map);
                                nomeTemp = "<?php echo $array[$index][0] ?>";
                                descTemp = "<?php echo $array[$index][1] ?>";
                                userTemp = "<?php echo $array[$index][4] ?>";
                                
                                
                                
                                dati[j] = new Array(nomeTemp,descTemp,posTemp,userTemp);
                                step(dati[j]);
                
                            function step(data){
                                google.maps.event.addListener(posTemp, 'click', function() {
                                showClick(data);});
                             }                                       
                                j++;
                            <?php 
                                 
                                $index++; } ?> 
             
                                
                         function showClick (marker){
                                      
          
                                var nome = marker[0];
                                var descrizione = marker[1];
                                var pos = marker[2];
                                var segnalatoDa =  marker[3];
                                
                                   
                                pos.setAnimation(google.maps.Animation.BOUNCE);
                                
                               
                                document.getElementById("nome").innerHTML =nome;
                                document.getElementById("descrizione").innerHTML =descrizione;
                                document.getElementById("segnUser").innerHTML = segnalatoDa;
                                document.getElementById("segnUser").setAttribute('href', 'generalProfile.php?gianni=' + segnalatoDa);
                                
                                
                                
                        }  
        }
        
            
        </script>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
        
    </body>
    
    
</html>

