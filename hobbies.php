<?php require 'header.php';
//TODO list
//- add a return to contacts link;

if (!empty($_GET['hobby'])){
    $get_hobby = $_GET['hobby'];
} else{
 print 'there is a problem';
 die();
}

$listOfPesrsonsHobby = getAllUsersForHobby($get_hobby);

$list = "";
foreach($listOfPesrsonsHobby as $hobby){
    $intern = getInternInfos($hobby['id']);
    $href_link = "href='single.php?id=$intern[id]'";
    $link = "<a $href_link>$intern[lastname] $intern[firstname]</a>";

    $list =$list. "<li>$link</li>";

}    

echo "<h2>Hobby : $hobby[hobby]</h2>";
echo "<ul>$list</ul>";

require 'footer.php';
?>