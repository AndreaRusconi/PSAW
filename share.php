<?php
session_start();
include("db_con.php");
if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
if(isset($_POST['submit'])) {
    $nomeEvento = $_POST['nome'];
    $descrizione = $_POST['descrizione_evento'];
    $username = $_SESSION['username'];
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $giorno = $_POST['dataE'];
    $ora = $_POST['timeE'];
    $cate = $_POST['categoria'];

    $conn = connection();

    $stmt = $conn->prepare("INSERT INTO event (nome,descrizione,latitudine,longitudine,user,giorno,ora,categoria) VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssddssss", $nomeEvento,$descrizione,$lat,$long,$username,$giorno,$ora,$cate);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: search.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/Bar.css" />
        <title>share</title>

        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="jquery.validate.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js" ></script>
        <script src="jonthornton-jquery-timepicker-e417a53/jquery.timepicker.min.js"></script>
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
            <li id="modulo">
                <form method="post" id="modulo_share"  name="event" autocomplete="off" >

                    <h1 id= "istruzione">Drag the marker..</h1>
                    <label class="labels" id ="label_nome" for="nome">Nome evento:</label>
                    <div class="labels">

                        <input id="nome" name="nome" type="text" required aria-required="true" autocomplete="off"  placeholder="Inserisci nome">
                    </div>
                    <div class="labels">
                        <label id ="tendina" for="dropdown">Seleziona categoria:</label>
                        <div class="dropdown" nome= "dropdown">
                            <input class="dropbtn" id="categoria" name="categoria" placeholder="---" required="required" aria-required="true" type="text">
                            <div class="dropdown-content">
                                <p class="opzione" onclick="category(this)">Concerto</p>
                                <p class="opzione" onclick="category(this)">Sagra</p>
                                <p class="opzione" onclick="category(this)">Spettacolo Teatrale</p>
                                <p class="opzione" onclick="category(this)">Fuochi D'Artificio</p>
                                <p class="opzione" onclick="category(this)">Discoteca</p>
                                <p class="opzione" onclick="category(this)">Altro</p>
                            </div>
                        </div>
                    </div>
                    <div class="labels">
                        <label  id ="descLabel" for="descrizione">Inserisci qui una descrizione:</label>
                        <textarea id="descrizione_evento" name="descrizione_evento" required="required" autocomplete="off" aria-required="true" placeholder="Inserisci una descrizione"></textarea>
                    </div>
                    <label class="labels" id="label_giorno"  for="dataE">Giorno:</label>
                    <label class="labels" id="label_ora" for="timeE">Ore:</label>
                <div>

                    <input type="datetime" name="dataE" id="dataE" required aria-required="true" placeholder="dd-mm-yy">
                    <input type="time" name="timeE" id="timeE" required aria-required="true">
                </div>
                    <div class="labels">
                        <input type="checkbox"  id="remBox" name="remember_me" onclick="unlock(this)" checked >
                        <label id="remLabel" for="remBox">Utilizza la geolocalizzazione</label>
                    </div>
                    <label id="addressLabel" for="address">Via/Piazza:</label>
                    <div class="labels">

                        <input id="address" name="address" required aria-required="true" autocomplete="off"  placeholder="">
                    </div>
                    <ul id="pos">
                        <li>
                            <input id="lat" name="lat" type="text" required="required" aria-required="true" value=""  placeholder="latitudine" hidden="hidden">

                        </li>

                        <li>
                             <input id="long" name="long" type="text" required="required"  aria-required="true" value=""  placeholder="longitudine" hidden="hidden">
                        </li>
                    </ul>
                    <input class="tasto_giallo" id="giallo_2" name="submit" type="submit" value="Share">

            </form>
        </li>
    </ul>
        <script>
            function category(category){
                var temp = category.innerHTML;
                document.getElementById("categoria").value = temp;

            }
            var x;
            var y;
            var poss;
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(function(position) {
                    var geocoder_0 = new google.maps.Geocoder();
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    x = pos.lat;
                    y = pos.lng;
                    poss = pos;
                    geocoder_0.geocode({'location': poss}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                document.getElementById('address').value = results[0].formatted_address;
                                }
                        }
                    });
                    document.getElementById("lat").value = x;
                    document.getElementById("long").value = y;
                });
            }
            else{
                alert('La geo-localizzazione NON è possibile');
            }
            function unlock(check) {
                var geocoder_1 = new google.maps.Geocoder();
                if(check.checked) {
                    document.getElementById("lat").value = x;
                    document.getElementById("long").value = y;
                    geocoder_1.geocode({'location': poss}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                document.getElementById('address').value = results[0].formatted_address;
                            }
                        }
                    });
                }
                else {
                    document.getElementById("lat").value = "";
                    document.getElementById("long").value = "";
                }
            }
            function myMap() {
                var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                var mapProp= {center: startCenter ,zoom:15,mapTypeControl: true,navigationControl: true,};
                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                var geocoder = new google.maps.Geocoder();
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
                            geocoder.geocode({'location': marker.position}, function(results, status) {
                                if (status === 'OK') {
                                    if (results[0]) {
                                        document.getElementById('address').value = results[0].formatted_address;
                                    }
                                }
                             });
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