<?php

//TODO:
// - Do some verifications??
// - If all is good sent lo index.php
// - If there is a problem send to newContact.php
// - Include a try catch in isEmpty()
// - Add element for hobbies. Maybe once the connection is done?
// - Verify for the computer if it exists already, if not, create a new computer.
// - Add the exist case for each element.

$get = $_GET;
isEmpty($get);

function isEmpty($get){
    if (!empty($get)){
        $lastname = $get['lastname'];
        $firstname = $get['firstname'];
        $birthday = $get['birthday'];
        $gender = $get['gender'];
        $computer = $get['computer'];

        $found = array_partial_search( array_keys($get), 'hobby');
        $hobbies = [];
        foreach($found as $hobby){
            $hobbies[] = $get[$hobby];
        }
        echo '<br>';
        addToMySQL($lastname, $firstname, $birthday, $gender, $computer, $hobbies);
    }
    else {
        echo "error level 1";
        die();
    }
}

function array_partial_search( $array, $keyword ) {
    $found = [];
    // Loop through each item and check for a match.
    foreach ( $array as $string ) {
        // If found somewhere inside the string, add.
        if ( strpos( $string, $keyword ) !== false ) {
            $found[] = $string;
        }
    }
    return $found;
}

function existCase($search){
    if (!empty($search)){
    }
    else{
        echo "error level 2 : $search";
        die();
    }
}

function db_connect(){
    require 'connection.php';
      
    try{
        $noName = "mysql:host=".$address.";dbname=".$database;
        $db = new PDO($noName, $user, $pass);
        return $db;
    }
    catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

function addToMySQL($lastname, $firstname, $birthday, $gender, $computer, $hobbies){

    $pdo = db_connect();
    $sql = "INSERT INTO interns (lastname, firstname, birthday, gender, computer_id) VALUES (?,?,?,?,?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$lastname, $firstname, $birthday,$gender,$computer]);

    //get the element

    $id = getIdFromName($lastname);
    //add the hobbies

    addHobby($id['id'], $hobbies);
    header('location: index.php');


}

function addHobby($id, $hobbies){
    $pdo = db_connect();
    foreach($hobbies as $hobby){
        $sql = "INSERT INTO interns_hobbies (intern_id, hobby_id) VALUES (?,?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$id, $hobby]);
    }
}

function getIdFromName($lastname){
    $db = db_connect();
    $query = "  SELECT id
                FROM interns
                WHERE lastname = '".$lastname."';";
                
    $stmt = $db->query($query);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

?>