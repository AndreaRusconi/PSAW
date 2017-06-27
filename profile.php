<?php
session_start();
// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa


include("db_con.php");

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}

$segn = $_SESSION['var'];
echo $segn;

$username = $_SESSION['username'];
$flag = true;


if($segn != $username){
    $flag = false;
    
}

$conn = connection();

if($flag){
  $sql = "SELECT * FROM users WHERE username = '{$username}'";
}
else{
   $sql = "SELECT * FROM users WHERE username = '{$segn}'"; 
}
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      
       while($row = $result->fetch_assoc()) {
               $email = $row["email"];
                $name = $row["nome"];
                $surname = $row["cognome"];
                $citta = $row["citta"];    
           
       }
  }
  


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
    <link rel="stylesheet" href="CSS/profile.css" />
    <title>Profile</title>
</head>



<body>

<ul id="menu">
    <li class="other"><a href="logout.php">logout</a></li>
    <li class="other"><a href="profile.php" > <?php echo $_SESSION['username'] ?> </a></li>
    <li class="barra"><a>|</a></li>
    <li class="other"><a href="info.php">info</a></li>
    <li class="other"><a href="aboutUs.php">about us</a></li>
    <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
</ul>
    
    <h1>Ciao Gianni</h1>
    <ul id="canvas">
        <li id="imgCanv"><img src="CSS/Images/logo.png" height="100px" width="250px"></li>
        <li id = "dataCanv">
            <ul id = "data">
                <li id="nome"><?php echo $name ?></li>
                <li id="cognome"><?php echo $surname ?></li>
                <li id="email"><?php echo $email ?></li>
                <li id="citta"><?php echo $citta ?></li>
                <li id="modifica"><a href="modify.php">Modifica profilo </a></li>
            </ul>
        </li>
    
    </ul>





</body>

</html>