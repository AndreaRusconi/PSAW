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

/*   $sql = "SELECT username FROM users";
   $result = $conn->query($sql);
   echo "sono fuori"

   if ($result->num_rows > 0) {
       echo "sono nel if";
       while($row = $result->fetch_assoc()) {

           if ($row["username"] == $username){
               $email = $row["email"];
               $name = $row["nome"];
               $surname = $row["cognome"];
           }
       }
  }
  */
if(empty($username)){
    $username = 'none';
}


if(empty($name)){
    $name = 'none';
}

if(empty($surname)){
    $surname = 'none';
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

<h1 id="head">
    <?php echo $name ?> <?php echo $surname ?> <a href="modify.php" class="modify">Modifica profilo </a>

</h1>



</body>

</html>