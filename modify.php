<?php

// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa
session_start();

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
include("db_con.php");



$username = $_SESSION['username'];




$conn = connection();  




  $stmt = $conn->prepare("SELECT nome,cognome,email,citta FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    
    $stmt->execute();
     $stmt->bind_result($name,$surname,$email,$city);
    
   // $result = $conn->query($sql);
    
    $stmt->fetch();
    $stmt->close();













/*

$sql = "SELECT nome,cognome,email,citta FROM users WHERE username = '{$username}'";
$result = $conn->query($sql);
     
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row["nome"];
            $surname = $row["cognome"];
            $email = $row["email"];
            $city = $row["citta"];
        }
    }
    else {
        echo "0 results";
    }
*/

if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    
    
    
    
     
    $stmt1 = $conn->prepare("UPDATE users SET email=?, nome=?, cognome=? ,citta=? WHERE username = '{$username}'");
    $stmt1->bind_param("ssss", $email, $name, $surname, $city);
    
    $stmt1->execute();
    
    $stmt1->close();
    $conn->close();
    
    header ("location:generalProfile.php?gianni=$username");
    
    
    
    //$sql = "UPDATE users SET email = '{$email}', nome = '{$name}', cognome = '{$surname}' WHERE username = '{$username}'";
    //$result = $conn->query($sql);
    
}




if(empty($name)){
    $name = 'none';
}

if(empty($surname)){
    $surname = 'none';
}

if(empty($email)){
    $email = 'none';
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
    <input id="email" name="email" type="email" required="required" aria-required="true" value="<?php echo $email ?>">
    
    <div class="box">
    <label id="cityLabel" for="city">City</label>
     </div>
    <input id="city" name="city" type="text" required="required" aria-required="true" value="<?php echo $city ?>">
    
    
    
    <a href="mod_pass.php" id="pass">Modifica password </a>
    <input id="modifyaccount" name = "submit" type = "submit" value = "Conferma">

</form>
</body>