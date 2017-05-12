<?php

function connection(){

    $conn =  new mysqli("localhost","filoandre","ciaociao", "filoandre");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    return $conn;
}

?>