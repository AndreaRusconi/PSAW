<?php
session_start();
// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa


include("db_con.php");

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}

$username = $_SESSION['username'];
$flag = true;





$var = $_GET['var'];

$sourceImage = sha1($var);
if($var != $username){
    $flag = false;
}

$conn = connection();

    

    $stmt = $conn->prepare("SELECT email,nome,cognome,citta FROM users WHERE username = ?");
    $stmt->bind_param("s", $var);
   
    $stmt->execute();
     $stmt->bind_result($email,$name,$surname,$citta)  ; 

$stmt->fetch();
$stmt->close();
    

if(empty($name)){
    $name = 'none';
}

if(empty($surname)){
    $surname = 'none';
}
if(empty($citta)){
    $citta = 'none';
}



?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/generalProfile.css" />
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
    <li id="imgCanv"><img id = "image" src="../profile_images/<?php echo $sourceImage; ?>.jpg"></li>
    <li id = "dataCanv">
        <ul id = "data">
            <li class="datalist"><?php echo $name ?></li>
            <li class="datalist"><?php echo $surname ?></li>
            <li class="datalist"><?php echo $email ?></li>
            <li class="datalist"><?php echo $citta ?></li>
            <li id="modifica"><a href="<?php if($flag){echo 'modify';}else{echo 'msg_received';}?>.php?var=<?php echo $var; ?>"><?php if($flag){echo 'modifica profilo'; }else{echo ' invia messaggio ';} ?></a></li>
            
        </ul>
    </li>
    <li id="eventCond">
        <ul>
            <li></li>
            <li></li>
        
        </ul>
    </li>

</ul>
<div class="roundContainer">
        <br><br>
        <p class="pageText">MODIFICA IMMAGINE</p>
        <div id="error"></div>
        <br><br>
        <form action="serv_changeimg.php" method="post" enctype="multipart/form-data" style="color:white;">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>

</body>
</html>
