<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28/06/2017
 * Time: 11:09
 */
?>
<!DOCTYPE html>

<head>

    <link rel="stylesheet" href="CSS/messages.css" />
    <title>Message</title>
</head>

<body>
<ul id="menu">

    <li class="other"><a href="<?php if($ok){echo "logout";} else{echo "login";} ?>.php"><?php if($ok){echo "logout";} else{echo "login";} ?></a></li>
    <li class="other"><a href="<?php if($ok){echo "generalProfile";} else{echo "registration";} ?>.php?var=<?php echo $_SESSION['username'] ?>"><?php if($ok){echo $_SESSION['username'];} else{echo 'sign up';} ?></a></li>
    <li class="barra"><a>|</a></li>
    <li class="other"><a href="info.php">info</a></li>
    <li class="other"><a href="aboutUs.php">about us</a></li>
    <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
</ul>


<form class="mess" method = "post" >
    <label id="emailLabel" class="estremi" for="mittente">Da:</label>
    <h1 id ="mittente">gianni</h1>
    <label id="emailLabel" class="estremi" for="destinatario">A:</label>
    <li id="destinatario"> paolo </li>
    <textarea id="oggetto" name="oggetto" rows="1" cols="20" placeholder="Inserisci l'oggetto del messaggio"> </textarea>
    <textarea id="testo" name="testo" rows="10" cols="30" placeholder="Inserisci messaggio"> </textarea>
    <input id="invia" name = "submit" type = "submit" value = "INVIA">

</form>









</body>
