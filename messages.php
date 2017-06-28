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
        $array[$tot][2];
         
         foreach ($row as $cord){
             
            $array[$i][0] =  $cord['username']; 
            $array[$i][1] =  $cord['commento'];
           
            $i = $i + 1;
         }

if(isset($_POST['submit'])) {   
    
    
            $commento = $_POST['descrizione'];
    
            
            $stmt = $conn->prepare("INSERT INTO message (username,nome,commento) VALUES(?,?,?)");
            $stmt->bind_param("sss", $username,$nomeEvento,$commento);
            $stmt->execute();
            $stmt->close();
            header("Location: messages.php?var=$nomeEvento");
}


?>
<!DOCTYPE html>

<head>

    <link rel="stylesheet" href="CSS/messages.css" />
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
    
    <h1><?php echo $nomeEvento; ?></h1>
    
    <?php 
    
    echo "<table id = 'table'>";
    echo "<tr>
            <th id ='com'>Commento</th>
            <th id='mit'>Mittente</th>
          </tr>";
    
    $j =0;
    
    while($j < $tot){
            
        echo "<tr>
                <td>{$array[$j][1]}</td>
                <td>{$array[$j][0]}</td>
              </tr>";
        $j ++;
    
    }
    echo "</table>";
    
    ?>
    <form method="post" class="menu" name="event" autocomplete="off" novalidate="">
    <textarea id="descrizione" name="descrizione"></textarea>
    
        <input id="accesso" name="submit" type="submit" value="commenta">
    </form>

</body>
