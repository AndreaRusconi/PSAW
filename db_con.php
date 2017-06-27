<?php

function connection(){

    $conn =  new mysqli("localhost","root","ciaociao", "filoandre");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

?>