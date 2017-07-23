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
    $address = $_POST['address'];

    $conn = connection();

    $stmt = $conn->prepare("INSERT INTO event (nome,descrizione,latitudine,longitudine,user,giorno,ora,categoria,indirizzo) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssddsssss", $nomeEvento,$descrizione,$lat,$long,$username,$giorno,$ora,$cate,$address);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: search.php?var=$nomeEvento");
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
                                <p class="opzione" onclick="category(this)">Party</p>
                                <p class="opzione" onclick="category(this)">Altro..</p>
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
                    
                    <label class ="labels"  id="addressLabel" for="address">Via/Piazza:</label>
                    <ul class="labels" id="findBox">

                        <li><input id="address" name="address" required aria-required="true" autocomplete="off"  placeholder=""></li>
                        <li id="find" onclick="find()">find</li>
                    </ul>
                    
                    
                    <div class="labelsBox">
                        <input  type="checkbox"  id="remBox" name="remember_me" onclick="unlock(this)" checked >
                        <label  id="remLabel" for="remBox">Utilizza la geolocalizzazione</label>
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
    </body>
</html>       
         <script src="js/share.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>
 