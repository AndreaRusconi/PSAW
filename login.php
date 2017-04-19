
<?php
//startiamo una sessione che chiameremo login vedremo poi perchè, ti consiglio comunque di cercare qualche guida a riguardo
session_start(login);
//ora creiamo il codice per definire quando clicchiamo sul bottone "Accedi" che ha come nome "invia" ricordati che abbiamo definito come metodo del form "post" e quindi faremo così
if($_POST['invia']){
//richiamiamo i valori dell'username e della password in variabili
$user=$_POST['username'];
$pass=$_POST['password'];
//Ora cripto la variabile della password con un algoritmo per aumentare la sicurezza, si può non usare ma  è consigliato
$md5=md5($pass);

//ora leggo il file .txt vedremo dopo come crearlo questo file che si chiamerà account.txt per l'account e password.txt per la password per leggere si usa la funzione fopen("nomefile" , 'r') ti consiglio di leggere qualche guida in proposito
$userfp=fopen("account.txt" , 'r'); 
//preleviamo ciò che c'è scritto nel file account.txt, si usa la funzione fread(variabile da utilizzare, numero caratteri da leggere nel file);  io uso 100 così per fare amemttiamo che un user usi un nome svedese o stranissimo (dico svedese così perchè c'avevo voglia)
$userdati = fread($userfp, 100);
//facciamo lo stesso come per la password
$passfp=fopen("password.txt" , 'r'); 
$passdati = fread($passfp, 100);

//ora creiamo due condizioni , se  user combacia con userdati  e  se pass combacia ccon passdati allora saremo spediti alla pagina segreta.php
if($user==$userdati && $md5==$passdati){
//qua apriremo una sessione, quella del login che definniremo come il nome dell'username che abbiamo registrato
$_SESSION['login']=$user;
//ora ci creiamo un redirect che ci porterà alla pagina segreta.php
header("Location:segreta.php");
}
//invece se sono diversi ci darà errore che possiamo farlo come testo normale o come messaggio d'errore con un alter oppure come più ti aggrada
else{
echo "<script>alert('Username o password errati!');</script>";
}
}

?>