<?php include 'header.php';

$interns = getInterns();
foreach($interns as $intern){
    $computer = getInternComputer($intern['id']);

    $img =  "<img class='img_user' src='images/user.svg'>";

    $href_link = "href='single.php?id=$intern[id]'";
    $link = "<a $href_link>$intern[lastname] $intern[firstname]</a>";
    $h2 =  "<h2>$link</h2>";

    echo $img . $h2;

}
 include 'footer.php'; ?>