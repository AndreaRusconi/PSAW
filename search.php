<?php
session_start();
$ok=false;
if(isset($_SESSION['username'])){
        $ok = true;
    }

 
include("db_con.php");
    
    $varSearch = $_GET['var'];
    $conn = connection();

    $dati = array();
    $dataOdierna = date("Y-m-d");
    
    $result = $conn->query("SELECT * FROM event WHERE giorno >= '{$dataOdierna}'");
  
    
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()){
             array_push($dati, array('nome' => $row['nome'], 'descrizione' => $row['descrizione'], 'latitudine' => $row['latitudine'], 'longitudine' => $row['longitudine'],'user' => $row['user'],'giorno' => $row['giorno'],'ora' => $row['ora'],'categoria' => $row['categoria'], 'indirizzo' => $row['indirizzo']));
         }
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/Bar.css" />
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
            <li class="dropdown_search" nome= "dropdown_search">
                            <input class="dropbtn_search" id="categoria" name="categoria" value="Categoria">
                                <div class="dropdown-content_search">
                                    <p class="opzione" onclick="category(this)">Tutti gli eventi</p>
                                    <p class="opzione" onclick="category(this)">Concerto</p>
                                    <p class="opzione" onclick="category(this)">Sagra</p>
                                    <p class="opzione" onclick="category(this)">Spettacolo Teatrale</p>
                                    <p class="opzione" onclick="category(this)">Fuochi D'Artificio</p>
                                    <p class="opzione" onclick="category(this)">Party</p>
                                    <p class="opzione" onclick="category(this)">Altro..</p>
                                </div>
            </li>
            
        
        
        </ul>

        <div id="googleMap_2">
        </div>
    
       
        
        
    </body>
    
    
</html>

<script>
    var dati = <?php echo json_encode($dati, JSON_PRETTY_PRINT) ?>;
    var varSearch = <?php echo json_encode($varSearch, JSON_PRETTY_PRINT) ?>;
</script>
        <script src="js/search.js"></script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHeG6rgq9ZgNU0JLhWdSkLssYLrH6yVY&callback=myMap"></script>

