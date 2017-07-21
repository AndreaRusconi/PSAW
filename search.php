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
        $array = array(array());
        
         
         foreach ($row as $cord){
             
            $array[$i][0] =  $cord['nome']; 
            $array[$i][1] =  $cord['descrizione'];
            $array[$i][2] =  $cord['latitudine'];
            $array[$i][3] =  $cord['longitudine'];
            $array[$i][4] =  $cord['user'];
            $array[$i][5] =  $cord['giorno'];
            $array[$i][6] =  $cord['ora'];
            $array[$i][7] =  $cord['categoria'];
          

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
        <li class="other"><a href="<?php if($ok){echo "Generalprofile";} else{echo "registration";} ?>.php?var=<?php echo $_SESSION['username'] ?>"><?php if($ok){echo $_SESSION['username'];} else{echo 'sign up';} ?></a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>    
        
        
        
   
    
        <ul id="box">
            <li id="googleMap">
            </li>
        
        
            <li id="dataEvent">
                
                <div id= "testo">Seleziona un Evento...</div>
                <div id="nome"></div>
                <div id= "descrizione"></div>
                <div id="giorno"></div>
                <div id="ora"></div>
                <div id='segnalazione'><a id= 'segnUser'></a></div>
                <div id ="comment"><a id='message'></a></div>
                <div id ="cate"></div>
                
               
                
                
            </li>
            
        </ul>    
    
        <script>
        
            function myMap() {
                        
                      
                        
                            var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                            var mapProp= {center: startCenter ,zoom:11,};
                            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                            var infowindow;
                
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
                
                            
                            dati = new Array();
                            totMarker = new Array();
                        
                            var j = 0;
            
                            <?php $index=0;
                                    while ($index < $tot) {
                                    
                            ?>  
                                
                                var posMarker = new google.maps.LatLng(<?php echo $array[$index][2] ?>,<?php echo $array[$index][3] ?>);
                                marker1 = new google.maps.Marker({position:posMarker});
                                marker1.infowindow = new google.maps.InfoWindow({
                                        content: 'An InfoWindow'
                                    });
                                    
                               totMarker[j] = marker1;
                               
                                marker1.setMap(map);
                                nomeTemp = "<?php echo $array[$index][0] ?>";
                                descTemp = "<?php echo $array[$index][1] ?>";
                                userTemp = "<?php echo $array[$index][4] ?>";
                                giornoTemp = "<?php echo $array[$index][5] ?>";
                                timeTemp = "<?php echo $array[$index][6] ?>";
                                categTemp = "<?php echo $array[$index][7] ?>";
                                
                                
                                dati[j] = new Array(nomeTemp,descTemp,marker1,userTemp,giornoTemp,timeTemp,categTemp);
                                step(dati[j]);
                
                            function step(data){
                                google.maps.event.addListener(marker1, 'click', function() {
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
                                var giorno = marker[4];
                                var ora = marker[5];
                                var categ = marker[6];
                                 
                            for(var n = 0; n < totMarker.length ; n++){
                                
                                totMarker[n].setAnimation(null);
                                totMarker[n].infowindow.close();
                               
                                
                            }
        
                             
                             
                                         
                                pos.setAnimation(google.maps.Animation.BOUNCE);
                                
                                pos.infowindow.open(map, pos);
                             
                             
                             
                            
                            
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                                document.getElementById("nome").innerHTML =nome;
                                document.getElementById("descrizione").innerHTML =descrizione;
                                document.getElementById("segnUser").innerHTML = segnalatoDa;
                                document.getElementById("giorno").innerHTML =  giorno;
                                document.getElementById("ora").innerHTML =  ora;
                                document.getElementById("segnUser").setAttribute('href', 'generalProfile.php?var=' + segnalatoDa);
                                document.getElementById("message").innerHTML =  'commenti';
                                document.getElementById("message").setAttribute('href', 'messages.php?var=' + nome);
                                document.getElementById("cate").innerHTML = categ;
                                
                        }  
        }
        
            
        </script>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
        
    </body>
    
    
</html>

