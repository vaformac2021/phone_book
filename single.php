<?php require 'header.php';
if (!empty($_GET['id'])){
    $id = $_GET['id'];
} else{
 print 'there is a problem';
 die();
}

$infos = getInternInfos($id);
$brand = getInternComputer($id);
$hobbies = getInternHobbies($id);

$h2_content = "$infos[lastname] $infos[firstname]";
echo "<h2>$h2_content</h2>";

$href_link = "href='computer.php?id=$infos[computer_id]'";
$link ="<a $href_link>$brand[brand]</a>";
$div = "<div>Computer: $link</div>";
echo $div;

$list = "";
foreach($hobbies as $hobby){
    $href_link = "href='hobbies.php?hobby=$hobby[hobby]'";
    $link = "<a $href_link>$hobby[hobby]</a>";

    $list =$list. "<li>$link</li>";
}
echo "<div>Hobby:<ul>$list</ul></div>";

require 'footer.php';
?>