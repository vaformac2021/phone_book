<?php include 'header.php';?>
<style>
    .buttonBack{
        display:none;
    }
</style>
<?php 

$interns = getInterns();

$divContact = "";
foreach($interns as $intern){
    $computer = getInternComputer($intern['id']);

    $img =  "<img class='img_user' src='images/user.svg'>";

    
    $h2 =  "<h2>$intern[lastname] $intern[firstname]</h2>";
    $contact = "<div class='contact'> $img $h2</div>";
    $href_link = "href='single.php?id=$intern[id]'";
    $link = "<a $href_link>$contact</a>";
    $divContact = $divContact . $link;

    
}

echo "<h1>Contacts</h1>";

$img =  "<img class='img_add_user' src='images/add_user.svg'>"; 
$h2 =  "<h2>Add User</h2>";
$divAddContact = "<div class='contact'> $img $h2</div>";
$href_link = "href='newContact.php'";
$link = "<a $href_link>$divAddContact</a>";
echo "<div class='contacts'>$link $divContact<div>";
 include 'footer.php'; ?>