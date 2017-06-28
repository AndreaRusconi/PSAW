<!DOCTYPE html>
<html style="height:100%;">
<head>
    <title>Cars Of The People</title>
    <link rel=stylesheet href="reset_css.css">
    <link rel="stylesheet" href="logged.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js" ></script>
    <script>
        $('document').ready(function() {
            var msglinks = document.getElementsByClassName("msg-a");
            for (i = 0; i<msglinks.length; i++) {
                msglinks[i].onclick = function () {
                    $("#msgshown").fadeIn("slow");
                    var recipient = this.getAttribute("data-rec");
                    var when = this.getAttribute("data-when");
                    var sender = <?php session_start(); echo "'".$_SESSION['user_email']."'"; ?>;
                    var data = "sender=" + sender + "&when=" + when + "&recipient=" + recipient;
                    $.ajax({
                        type:'GET',
                        url: "serv_getmsgtext.php",
                        data: data,
                        beforeSend: function() {
                            // da vedere
                        },
                        success: function (data) {
                            $("#msgshown2").text(data);
                        }
                    });
                };
            }
        });
    </script>
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

        <div id="msgshown">
            <button id="msgshow-close" style="float: right;" onclick="$('#msgshown').fadeOut('slow');">chiudi</button>
            <div id="msgshown2">
            </div>
        </div>

        <div id="msgdiv">
            <br><br><br><br><br><br><br><br><br>
            <table class="msgtable">
                <?php
                    require_once("serv_checklogin.php");
                    require_once("serv_config.php");

                    $sql = "SELECT recipient,title,msg_date FROM message WHERE sender='{$_SESSION['user_email']}' ORDER BY msg_date DESC;";
                    $res = mysqli_query($conn, $sql);

                    $numrow = mysqli_num_rows($res);
                    for($i = 0 ; $i < $numrow; $i++) {
                        $row = mysqli_fetch_row($res);
                        $row[0] = revescape($row[0]);
                        $row[1] = revescape($row[1]);
                        echo "<tr>";
                        echo "<td><a style='text-decoration: none; color: #00A162' href='showprofile.php?mail={$row[0]}'>" . $row[0]. "</a></td>";
                        echo "<td><a data-rec='".$row[0]."' data-when='".$row[2]."' class='msg-a' href='#'>".$row[1]."</a></td>";
                        echo "<td>".$row[2]."</td>";
                        echo "</tr>";
                    }
                    mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
</body>
</html>

