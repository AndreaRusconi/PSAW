<?php
session_start();
include("db_con.php");

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}

$username = $_SESSION['username'];
$flag = true;

$varProfile = $_GET['var'];

$sourceImage = sha1($varProfile);

if($varProfile != $username){
    $flag = false;
}

$infoPersonali = array();
$dati = array();


$conn = connection();


$stmt = $conn->prepare("SELECT email,nome,cognome,citta FROM users WHERE username = ?");
$stmt->bind_param("s", $varProfile);
   
$stmt->execute();
$stmt->bind_result($email,$nome,$cognome,$citta); 
$stmt->fetch();
array_push($infoPersonali, array('nome' => $nome , 'email' => $email, 'cognome' => $cognome, 'citta' => $citta));
$stmt->close();


$result = $conn->query("SELECT nome FROM event WHERE user = '{$varProfile}'");

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
             array_push($dati, array('nome' => $row['nome']));
         }
   }

$conn->close();


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
    <link rel="stylesheet" href="CSS/Bar.css" />
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
        <li id="img_canv"><img id = "image" src="../profile_images/<?php echo $sourceImage; ?>.jpg"></li>
        <li id = "data_canv">
        
            
            <table id = "datalist" class="tabellaProfile">
                
                
                <thead>
                    <tr>
                        <th id ="infoPers" class="intestation">Informazioni personali</th>
                    </tr>
                </thead>
                    
                        <tbody>
                            <tr>
                                <th class="datiTabella" id="nomeInfo"></th>
                            </tr>
                            <tr>
                                <th class="datiTabella" id="cognome"></th>
                            </tr>
                            <tr>
                                <th class="datiTabella" id="email"></th>
                            </tr>
                            <tr>
                                <th class="datiTabella" id="citta"></th>
                            </tr>
                            <tr>
                                <th class="datiTabella" id="to_modifica"><a href="<?php if($flag){echo 'modify';}?>.php"><?php if($flag){echo 'modifica profilo'; }?></a></th>
                            </tr>
	

	                   </tbody>
          </table>
        
        
        
        
        
        </li>
        <li id="event_canv">
            <table id='tabellaEventi' class="tabellaProfile">

            <thead>
                <tr>
                    <th id ="eventi" class="intestation" >Eventi condivisi</th>
                </tr>
            </thead>

	       <tbody>
                        
	    <!-- IL BODY E' INIZIALMENTE VUOTO -->

	       </tbody>

            </table>
        </li>
    </ul>

    <div class="roundContainer" <?php if(!$flag){ echo 'hidden';}?>>
            <p class="pageText">Modifica immagine del profilo</p>
            <div id="error"></div>
            <form action="modifyImage.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <input type="submit" value="Upload Image" name="submit" id="submit">
            </form>
        </div>

</body>
</html>










<script>

          
    var datiPersonali = <?php echo json_encode($infoPersonali, JSON_PRETTY_PRINT) ?>;
    
    
            document.getElementById('nomeInfo').innerHTML = datiPersonali[0]['nome'];
            document.getElementById('cognome').innerHTML = datiPersonali[0]['cognome'];
            document.getElementById('email').innerHTML = datiPersonali[0]['email'];
            document.getElementById('citta').innerHTML = datiPersonali[0]['citta'];
    
    
    
    
    
    
    
    
    
    
    var dati = <?php echo json_encode($dati, JSON_PRETTY_PRINT) ?>;
            
          
          

	     var table = document.getElementById('tabellaEventi');

	     var tbody = table.getElementsByTagName('tbody')[0];

	    
        for(let i in dati) { 
        
            var tr = document.createElement('tr');
            
            var td_0 = document.createElement('td');
            
            td_0.setAttribute('class','datiTabella');
            
            var tx_0 = dati[i]['nome'];
            
            var a_0 = document.createElement('a');
            
            a_0.innerHTML=tx_0;
            a_0.setAttribute('href', 'messages.php?var=' + dati[i]['nome']);
            
            td_0.appendChild(a_0);
            
            tr.appendChild(td_0);
            
            tbody.appendChild(tr);
	    
        }







</script>








