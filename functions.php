<?php


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

function getInterns(){
    $db = db_connect();
    $query = 'SELECT * FROM interns';
    $stmt = $db->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function getInternInfos($id){
    $db = db_connect();
    $query = "SELECT id, lastname, mail, firstname, birthday, gender, computer_id
    FROM interns i
    WHERE i.id = ".$id;
    $stmt = $db->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getInternComputer($id){
    $db = db_connect();
    $query = "SELECT brand FROM computers c 
    INNER JOIN interns i ON c.id = i.computer_id 
    WHERE i.id = ". $id;
    $stmt = $db->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getInternHobbies($id){
    $db = db_connect();
    $query = "SELECT hobby
    FROM interns i
    INNER JOIN interns_hobbies ih ON ih.intern_id = i.id
    INNER JOIN hobbies h ON ih.hobby_id = h.id
    WHERE i.id = ?";
    
    $statement = $db->prepare($query);
    $statement->execute(array($id));

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getUsersComputer($brand){
    $db = db_connect();
    $query = "SELECT i.id, brand
    FROM interns i
    INNER JOIN computers c
    ON i.computer_id = c.id 
    AND i.computer_id = ".$brand;
    $stmt = $db->query($query);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getAllUsersForHobby($hobby){
    $db = db_connect();
    $query = "SELECT i.id, h.hobby
    FROM interns i
    INNER JOIN interns_hobbies ih ON i.id = ih.intern_id
    INNER JOIN hobbies h ON ih.hobby_id = h.id
    WHERE h.hobby = ?";
    $statement = $db->prepare($query);
    $statement->execute(array($hobby));
    //$stmt = $db->query($query);

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getIdOfHobby($hobby){
    $db = db_connect();
    $query = "Select id
    from hobbies
    WHERE hobby = '" . $hobby . "'";
    $stmt = $db->query($query);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getHobbiesList(){
    $db = db_connect();
    $query = "  SELECT id, hobby
                FROM hobbies";
    $stmt = $db->query($query);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getComputersList(){
    $db = db_connect();
    $query = "  SELECT id, brand
                FROM computers";
    $stmt = $db->query($query);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


?>