<?php
    session_start();
    include("db_con.php");
    if(!isset($_SESSION['username'])){
        header ("location:login.php");
    }
    $nomeEvento = $_GET['var'];
    $username = $_SESSION['username'];
    $conn = connection();
    $dati= array();

    $stmt = $conn->prepare("SELECT username,commento FROM message WHERE nome= ?");
    $stmt->bind_param("s", $nomeEvento);
    $stmt->execute();
    $stmt->bind_result($mittente,$messaggio);
     
    if(empty($mittente)){
        $mittente = 'admin';
        $messaggio = 'Non ci sono messaggi';
    }
    do{
        array_push($dati, array('mittente' => $mittente, 'messaggio' => $messaggio));
    }while($stmt->fetch());
    
    $stmt->close();


    if(isset($_POST['submit'])) {   
        $commento = $_POST['descrizione']; 
        $stmt = $conn->prepare("INSERT INTO message (username,nome,commento) VALUES(?,?,?)");
        $stmt->bind_param("sss", $username,$nomeEvento,$commento);
        $stmt->execute();
        $stmt->close();
        header("Location: messages.php?var=$nomeEvento");
}

$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/Bar.css" />
        <title>Message</title>
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
        <ul id="messagesHead">
            <li id="messagesTitle"><?php echo $nomeEvento; ?></li>
            <li id="tornaAllaRicerca"><a href="search.php?var=null">Torna alla ricerca</a></li>
        </ul>
      
        <table id='tabella'>
            <thead>
                <tr>
                    <th id ="messaggio" class="voci">Messaggi</th>
                    <th id="mittente" class="voci">Mittente</th>
                </tr>
            </thead>
            <tbody>
                <!-- IL BODY E' INIZIALMENTE VUOTO -->
            </tbody>
        </table>
        <form method="post" class="testi" name="event" autocomplete="off">
            <textarea id="descrizione" name="descrizione" required></textarea>
            <button id="commento" name="submit" type="submit" value="commenta">Commenta</button>
        </form>
    </body>

</html>
<script type="text/javascript">var dati = <?php echo json_encode($dati, JSON_PRETTY_PRINT) ?>;</script>
<script type="text/javascript" src="js/messages.js"></script>