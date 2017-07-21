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

$conn = connection();


$stmt = $conn->prepare("SELECT email,nome,cognome,citta FROM users WHERE username = ?");
$stmt->bind_param("s", $varProfile);
   
$stmt->execute();
$stmt->bind_result($email,$name,$surname,$citta); 

$stmt->fetch();
$stmt->close();




$sql = "SELECT nome FROM event WHERE user = '{$varProfile}'";
   
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
        $array[$tot];
         
         foreach ($row as $cord){
             
            $array[$i] =  $cord['nome']; 

            $i = $i + 1;
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
            <ul id = "datalist">
                <li class="data"><?php echo $name ?></li>
                <li class="data"><?php echo $surname ?></li>
                <li class="data"><?php echo $email ?></li>
                <li class="data"><?php echo $citta ?></li>
                <li id="to_modifica"><a href="<?php if($flag){echo 'modify';}?>.php"><?php if($flag){echo 'modifica profilo'; }?></a></li>
            </ul>
        </li>
        <li id="eventCond">
            <ul id="eventi_condivisi">
                <li id = "item">Eventi condivisi</li>

                <?php
                    foreach ($array as $cord){
                        echo "<li class ='itemEvent'>".$cord."</li>";
                    }
                ?>

            </ul>
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
