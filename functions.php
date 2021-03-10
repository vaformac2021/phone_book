<?php


function db_connect(){
    include 'connection.php';    

    $dbh = new PDO('mysql:host=localhost;dbname=dwwm', $user, $pass);
    
}

?>