<?php
//startiamo la sessione login
session_start(login);
//e ora diciamo se quuesta sessione sta lavorando cosa succede
//Se sta lavorando succederà questo isset= lavora !isset= non lavora
if(isset($_SESSION['login']){
//diciamo di richiamare in variabile per facilitarci i compiti la sessione['login'] che contiene la variabile $user
$user=$_SESSION['login'];
//mostriamo questa variabile
echo "Ciao ".$user;
//per distruggere ovvero tornare alla pagina iniziale basta utilizzare la funzione session_destroy();

}

//mentre se non lavora e siamo sulla pagina segreta.php ci reinderizza automaticamente alla pagina index.php 
//in questo caso si può fare sia con else{} che con if(!isset($_SESSION['login']){}
else{
header("Location:login.php");
}
?>