<?php
session_start();
    if(isset($_SESSION['username'])){
        $ok = true;
    }
 
include("db_con.php");

    $conn = connection();

    $dati = array();
    $dataOdierna = date("Y-m-d");
    
    $result = $conn->query("SELECT * FROM event WHERE giorno >= '{$dataOdierna}'");
  
    
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()){
             array_push($dati, array('nome' => $row['nome'], 'descrizione' => $row['descrizione'], 'latitudine' => $row['latitudine'], 'longitudine' => $row['longitudine'],'user' => $row['user'],'giorno' => $row['giorno'],'ora' => $row['ora'],'categoria' => $row['categoria'],));
         }
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
        
        <ul id="head">
            
            <li id="titolone">
                <div id="testo">Seleziona un evento</div>    
            </li>
            <li class="dropdown" nome= "dropdown">
                            <input class="dropbtn" id="categoria" name="categoria" value="Categoria">
                                <div class="dropdown-content">
                                    <p class="opzione" onclick="category(this)">Tutti gli eventi</p>
                                    <p class="opzione" onclick="category(this)">Concerto</p>
                                    <p class="opzione" onclick="category(this)">Sagra</p>
                                    <p class="opzione" onclick="category(this)">Spettacolo Teatrale</p>
                                    <p class="opzione" onclick="category(this)">Fuochi D'Artificio</p>
                                    <p class="opzione" onclick="category(this)">Discoteca</p>
                                    <p class="opzione" onclick="category(this)">Altro</p>
                                </div>
            </li>
            
        
        
        </ul>
        
        
        
        
        
        
        
        
        
        
        
    
        <div id="googleMap">
        </div>    
    
        <script>
            
            
            
            var totMarker;
            var dati;
            
            
        
            function myMap() {
                        
                      
                        
                            var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                            var mapProp= {center: startCenter ,zoom:12,};
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
                
                            totMarker = new Array();
                
                            dati = <?php echo json_encode($dati, JSON_PRETTY_PRINT) ?>;
                        
                                for(let i in dati) {
                                    
                                var posMarker = new google.maps.LatLng(dati[i]['latitudine'],dati[i]['longitudine']);
                                marker = new google.maps.Marker({position:posMarker});
                                    
                                var string =   '<div id="nome">' + '<h1>' + dati[i]["nome"] + '</h1>' + '</div>' +
                                                    '<div id="descrizione">' + '<p>' + dati[i]["descrizione"] + '</p>' + '</div>'+
                                                '<div id="giorno">' + dati[i]["giorno"] + '</div>' + 
                                    '<div id="ora">' + dati[i]["ora"] + '</div>' +
                                    '<div id="user">' + '<a href="generalProfile.php?var=' + dati[i]['user'] + '">' + dati[i]["user"]+ '</a>'  + '</div>' +        
                                        '<div id="forum">' + '<a href="messages.php?var=' + dati[i]['nome'] + '">' + 'forum evento</a>' + '</div>'; 
                                    
                                marker.infowindow = new google.maps.InfoWindow({
                                        content: string
                                    });
                                    
                               
                                marker.setMap(map);
                                totMarker[i] = marker;
                                
                                    
                                showclick(marker);
                                
                                }
                
                            function showclick(data){    
                              
                                google.maps.event.addListener(data, 'click', function() {
                                
                                    for(var n = 0; n < totMarker.length ; n++){
                                
                                        totMarker[n].setAnimation(null);
                                        totMarker[n].infowindow.close();
                                    }
        
                             
                             
                                         
                                data.setAnimation(google.maps.Animation.BOUNCE);
                                
                                data.infowindow.open(map, data);
        
                             
                                });
                                }
                            
                
                          
        }
            
            
          function category(category){
                        var temp = category.innerHTML;
                        document.getElementById("categoria").value = temp;
                
                        for(var n = 0; n < dati.length ; n++){
                            
                            if(dati[n]['categoria'] != temp && temp != 'Tutti gli eventi'){
                               totMarker[n].setVisible(false);
                                totMarker[n].infowindow.close();
                            }
                            else
                                totMarker[n].setVisible(true);
                        
                    }
                 }
            
        
          
            
            
        </script>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
        
    </body>
    
    
</html>

