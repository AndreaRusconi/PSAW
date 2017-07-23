<?php
session_start();
include("db_con.php");
if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
$username = $_SESSION['username'];
$flag = true;
$varProfile = $_GET['var'];

if($varProfile != $username){
    $flag = false;
}
$infoPersonali = array();
$dati = array();
$conn = connection();
$stmt = $conn->prepare("SELECT email,nome,cognome,citta,immagine FROM users WHERE username = ?");
$stmt->bind_param("s", $varProfile);
$stmt->execute();
$stmt->bind_result($email,$nome,$cognome,$citta,$sourceImage); 
$stmt->fetch();

if(empty($nome)){$nome = 'nome';}
if(empty($cognome)){$cognome = 'cognome';}
if(empty($citta)){$citta = 'citta';}
if(empty($email)){
    echo '<script>alert("questo utente non esiste");</script>';
    header ("location:index.php");
}

if($sourceImage == 'default'){
    $immagine = "../profile_images/default.png";
}
else{
    $immagine = "../profile_images/";
    $immagine .= $sourceImage;   
}


 echo '<script>alert($immagine);</script>';

array_push($infoPersonali, array('nome' => $nome , 'email' => $email, 'cognome' => $cognome, 'citta' => $citta));
$stmt->close();
$result = $conn->query("SELECT nome FROM event WHERE user = '{$varProfile}'");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        array_push($dati, array('nome' => $row['nome']));
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/Bar.css" />    
    <title>Profile</title>
</head>
<body>
    <ul id="menu">
        <li class="other"><a href="logout.php">logout</a></li>
        <li class="other"><a href="generalProfile.php?var=<?php echo $_SESSION['username'] ?>" > <?php echo $_SESSION['username'] ?> </a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>
    <ul id="canvas">
        <li id="img_canv"><?php print"<img id = 'image' src = '$immagine'>";?></li>
        <li id = "data_canv">    
            <table id = "datalist" class="tabellaProfile">
                <thead>
                    <tr><th id ="infoPers" class="intestation">Informazioni personali</th></tr>
                </thead>
                <tbody>
                    <tr><td class="datiTabella" id="nomeInfo"></td></tr>
                    <tr><td class="datiTabella" id="cognome"></td></tr>
                    <tr><td class="datiTabella" id="email"></td></tr>
                    <tr><td class="datiTabella" id="citta"></td></tr>
                    <tr><td class="datiTabella" id="to_modifica"><a href="<?php if($flag){echo 'modify';}?>.php"><?php if($flag){echo 'modifica profilo'; }?></a></td></tr>	            
                </tbody>
            </table>
        </li>
        <li id="event_canv">
            <table id='tabellaEventi' class="tabellaProfile">
                <thead>
                    <tr><th id ="eventi" class="intestation" >Eventi condivisi</th></tr>
                </thead>
                <tbody><!-- IL BODY E' INIZIALMENTE VUOTO --></tbody>
            </table>
        </li>
    </ul>
    <div class="roundContainer" <?php if(!$flag){ echo 'hidden';}?>>   
        <p class="pageText">Modifica immagine del profilo</p>
        <div id="error"></div>
        <form action="modifyImage.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <input type="submit" value="Upload Image" name="submit" id="submit">
        </form>
    </div>
</body>
</html>
<script>
    var datiPersonali = <?php echo json_encode($infoPersonali, JSON_PRETTY_PRINT) ?>;
    var dati = <?php echo json_encode($dati, JSON_PRETTY_PRINT) ?>;
</script>
<script src="js/generalProfile.js"></script>