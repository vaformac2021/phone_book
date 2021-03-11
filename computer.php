<?php require 'header.php';
//TODO list
//- add a return to contacts link;

$id = $_GET['id'];

if (!empty($_GET['id'])){
    $id = $_GET['id'];
} else{
 print 'there is a problem';
 die();
}

$listOfPersons = getUsersComputer($id);



$list = "";
foreach($listOfPersons as $person){
    $intern = getInternInfos($person['id']);
    $href_link = "href='single.php?id=$intern[id]'";
    $link = "<a $href_link>$intern[lastname] $intern[firstname]</a>";

    $list =$list. "<li>$link</li>";

}    

echo "<h2>Computer : $person[brand]</h2>";
echo "<ul>$list</ul>";

require 'footer.php';
?>