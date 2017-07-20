<!DOCTYPE html>
<html>
<head>
    <title>Cars Of The People</title>
    <link rel=stylesheet href="reset_css.css">
    <link rel="stylesheet" href="logged.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js" ></script>
    <script src="js_msg_create.js"></script>
</head>
<body>
    <?php
        require_once("header.php");
        require_once("serv_config.php");
        $sql = "SELECT title FROM message WHERE recipient='{$_SESSION['user_email']}' AND is_read = FALSE;";
        $res = mysqli_query($conn, $sql);
        $nmsg = mysqli_num_rows($res);
    ?>

    <div class="fullScreenContainer">
         <br>
         <ul style="text-align: center;">
             <li class="msg_li"><a id="create" href="msg_create.php">CREA MESSAGGIO</a></li>
             <li class="msg_li"><a id="received" href="msg_received.php">MESSAGGI RICEVUTI <strong id="nmsg" num="<?php echo $nmsg ?>"><?php if($nmsg>0) echo "( ".$nmsg." )" ?></strong></a></li>
             <li class="msg_li"><a id="sent" href="msg_sent.php">MESSAGGI INVIATI</a></li>
         </ul>

         <div id="msgdiv">
             <div id="error"></div>
             <div>
                 <form id="msgform">
                     <p>Destinatario:</p><input type="text" id="msgdest" name="msgdest" value="<?php if(isset($_GET['dest'])) echo $_GET['dest']?>"><br>
                     <p>Oggetto:</p><input type="text" id="msgtitle" name="msgtitle"><br><br>
                     <textarea rows="20" cols="80" id="msgtext" name="msgtext"></textarea><br>
                     <input type="submit" id='send' name='send' value="Invia">
                 </form>
             </div>
         </div>
    </div>
</body>
</html>
