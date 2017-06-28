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

if(isset($_GET['submit'])) {

    $username = $_GET['username'];
    $password = $_GET['password'];
    $remember = $_GET['remember_me'];

    $cryptpassword = sha1($password);
    $good = false;
    $conn = connection();

    $sql = "SELECT username, password FROM users";
    $result = $conn->query($sql);

}

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
    <link rel="stylesheet" href="CSS/modify.css" />
    <title>Modify</title>
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



<form class="modifiche" method = "post" >
    <div id="title">Modifica profilo</div>
    
    <div class="box">
    <label id="nameLabel" for="name">Name</label>
    </div>
    <input id="name" name="name" type="text" required="required" aria-required="true" value="<?php echo $name ?>">
    
    
    <div class="box">
    <label id="surnameLabel" for="surname">Surname</label>
     </div>
    <input id="surname" name="surname" type="text" required="required" aria-required="true" value="<?php echo $surname ?>">
   
    <div class="box">
    <label id="emailLabel" for="surname">Email</label>
     </div>
    <input id="email" name="email" type="text" required="required" aria-required="true" value="<?php echo $email ?>">
    
    
    <a href="mod_pass.php" id="pass">Modifica password </a>
    <input id="modifyaccount" name = "submit" type = "submit" value = "Conferma">

</form>
</body>