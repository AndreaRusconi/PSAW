<?php
// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa
session_start();

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
include("db_con.php");

$conn = connection();

$username = $_SESSION['username'];
/*
  $sql = "SELECT * FROM users WHERE $username";
   $result = $conn->query($sql);
   echo "sono fuori"

   if ($result->num_rows > 0) {
       echo "sono nel if";
       while($row = $result->fetch_assoc()) {

                $email = $row["email"];
                $name = $row["nome"];
                $surname = $row["cognome"];
                $citta = $row["citta"];

       }
  }

*/

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
    <li class="other"><a href="profile.php" > <?php echo $_SESSION['username'] ?> </a></li>
    <li class="barra"><a>|</a></li>
    <li class="other"><a href="info.php">info</a></li>
    <li class="other"><a href="aboutUs.php">about us</a></li>
    <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
</ul>

<h1>Ciao Gianni</h1>
<ul id="canvas">
    <li id="imgCanv"><img src="CSS/Images/special.jpg" height="100px" width="250px"></li>
    <li id = "dataCanv">
        <ul id = "data">
            <li class="datalist"><?php echo $name ?></li>
            <li class="datalist"><?php echo $surname ?></li>
            <li class="datalist"><?php echo $email ?></li>
            <li class="datalist"><?php echo $citta ?></li>
            <li id="modifica"><a href="modify.php"><img src="CSS/Images/pencil2.png" > </a></li>
        </ul>
    </li>

</ul>

</body>
</html>



</body>

</html>