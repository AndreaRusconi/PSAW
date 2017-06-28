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
    <li class="other"><a href="generalProfile.php?gianni=<?php echo $_SESSION['username'] ?>" > <?php echo $_SESSION['username'] ?> </a></li>
    <li class="barra"><a>|</a></li>
    <li class="other"><a href="info.php">info</a></li>
    <li class="other"><a href="aboutUs.php">about us</a></li>
    <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
</ul>


<ul id="canvas">
    <li id="imgCanv"><img id = "image" src="CSS/Images/special.jpg" ></li>
    <li id = "dataCanv">
        <ul id = "data">
            <li class="datalist"><?php echo $name ?></li>
            <li class="datalist"><?php echo $surname ?></li>
            <li class="datalist"><?php echo $email ?></li>
            <li class="datalist"><?php echo $citta ?></li>
            <li id="modifica"><a href="<?php if($flag){echo 'modify';}else{echo 'messages';}?>.php"><?php if($flag){echo 'modifica profilo'; }else{echo ' invia messaggio ';} ?></a></li>
            
        </ul>
    </li>
    <li id="eventCond">
        
    </li>

</ul>

</body>
</html>
