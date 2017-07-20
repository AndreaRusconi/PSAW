<?php
session_start();

include("db_con.php");

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}


$nomeEvento = $_GET['var'];
$username = $_SESSION['username'];


$conn = connection();

$sql = "SELECT username,commento FROM message WHERE nome = '{$nomeEvento}'";
$result = $conn->query($sql);

$rowcount=mysqli_num_rows($result);
  
$tot = $rowcount;
    
if ($result->num_rows > 0) {
        while($rowcount>0){
            $row[$rowcount] = mysqli_fetch_assoc($result);
            $rowcount = $rowcount - 1; 
        }
}
$i = 0;
//$comments[$tot][2];
         
foreach ($row as $cord){
             
    $comments[$i][0] =  $cord['commento'];
    $comments[$i][1] =  $cord['username']; 
    $i = $i + 1;
}
       

if(isset($_POST['submit'])) {   
    
    
    
    
    $commento = $_POST['descrizione']; 
    if(empty($commento)){
       echo "<script>alert('commento obbligatorio')</script>";
        //header("Location: messages.php?var=$nomeEvento");  
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
    
    <?php 
    
    echo "<table id = 'tabella'>";
    echo "<tr>
            <th id ='com' class='voci'>Commento</th>
            <th id='mittente' class='voci'>Mittente</th>
          </tr>";
    
    $j =0;
    
    if($tot == 0){
        $tot = 1;
        $comments[0][0] = "non ci sono commenti";
         $comments[0][1] = "admin";
    }
    
    while($j < $tot){
            
        echo "<tr>
                <td class='linea'>{$comments[$j][0]}</td>
                <td class='linea'>{$comments[$j][1]}</td>
              </tr>";
        $j ++;
    
    }
    echo "</table>";
    
    ?>
    <form method="post" class="testi" name="event" autocomplete="off" novalidate="">
    <textarea id="descrizione" name="descrizione"></textarea>
    
        <input id="accesso" name="submit" type="submit" value="commenta">
    </form>

</body>
