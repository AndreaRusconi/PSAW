<?php
session_start();
    if(isset($_SESSION['username'])){
        $ok = true;
    }
?>



<!DOCTYPE html> 
<html> 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
	<title>Information</title> 
	<link rel="stylesheet" type="text/css" href="CSS/info.css"/>
    

</head> 
<body> 
    
    
      <ul id="menu">
        
        <li class="other"><a href="<?php if($ok){echo "logout";} else{echo "login";} ?>.php"><?php if($ok){echo "logout";} else{echo "login";} ?></a></li>
        <li class="other"><a href="<?php if($ok){echo "profile";} else{echo "registration";} ?>.php"><?php if($ok){echo $_SESSION['username'];} else{echo 'sign up';} ?></a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>
    
    <ul class="tit">
        
        <li id="link">
            <a href="index.php">Torna alla Homepage</a>
        </li>
        <li id="information">
            <h1>Information</h1>
        </li>
        
    </ul>
    
    
	
	<div id="container">
		
		<div id="wrapper">
			<!--
				immagini prese da 
				http://www.smashingmagazine.com/2008/07/11/50-remarkable-nature-wallpapers/ 
			-->
			<ul class="slider">
				
				<li>
					<img src="CSS/Images/1.jpg" id="img1" alt="" />
				</li>
				<li>
					<img src="CSS/Images/2.jpg" id="img2" alt="" />
				</li>
				<li>
					<img src="CSS/Images/3.jpg" id="img3" alt="" />
				</li>
				<li>
					<img src="CSS/Images/4.jpg" id="img4" alt="" />
				</li>		
			</ul>
			
		</div>
		<div class="navigation">
			<a href="#" class="nav_prev">Indietro</a>
			<a href="#img1" class="nav_btn">1</a>
			  <a href="#img2" class="nav_btn">2</a>
			  <a href="#img3" class="nav_btn">3</a>
			  <a href="#img4" class="nav_btn">4</a>
			<a href="#" class="nav_next">Avanti</a>
		</div>
		
		
	</div>
	

<footer class="footer" role="contentinfo">
    <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
</footer>


</body>
</html>