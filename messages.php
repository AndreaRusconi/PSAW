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
        
    while($stmt->fetch()){
        array_push($dati, array('mittente' => $mittente, 'messaggio' => $messaggio));
    }

    $stmt->close();


if(isset($_POST['submit'])) {   
     
    $commento = $_POST['descrizione']; 
    
    if(empty($commento)){
       echo "<script>alert('commento obbligatorio')</script>";
    }
    else{
    
        $stmt = $conn->prepare("INSERT INTO message (username,nome,commento) VALUES(?,?,?)");
        $stmt->bind_param("sss", $username,$nomeEvento,$commento);
        $stmt->execute();
        $stmt->close();
        header("Location: messages.php?var=$nomeEvento");
    }
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
    
    <h1 class="title"><?php echo $nomeEvento; ?></h1>
      
    
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
    
    <form method="post" class="testi" name="event" autocomplete="off" novalidate="">
    <textarea id="descrizione" name="descrizione"></textarea>
        <button id="commento" name="submit" type="submit" value="commenta">Commenta</button>
    </form>

</body>

</html>    

    
<script>  
        
        
        var dati = <?php echo json_encode($dati, JSON_PRETTY_PRINT) ?>;
            

	     var table = document.getElementById('tabella');

	     var tbody = table.getElementsByTagName('tbody')[0];

	    
        for(let i in dati) { 
        
            var tr = document.createElement('tr');
            
            var td_0 = document.createElement('td');
            var td_1 = document.createElement('td');
            
            td_0.setAttribute('class','linea');
            td_0.setAttribute('id','mitt');
	        td_1.setAttribute('class','linea');
            
            var tx_0 = dati[i]['mittente'];
            var tx_1 = dati[i]['messaggio'];
            
            var a_0 = document.createElement('a');
            
            a_0.innerHTML=tx_0;
            a_0.setAttribute('href', 'generalProfile.php?var=' + dati[i]['mittente']);
            
            td_0.appendChild(a_0);
            td_1.innerHTML=tx_1;
            
           
             
            tr.appendChild(td_1);
            tr.appendChild(td_0);
            
            tbody.appendChild(tr);
	    
        }
 
</script>