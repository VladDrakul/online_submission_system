<?php
//echo "<html><head><link rel=\"stylesheet\" type=\"text/css\" href=\"log.css\"</head><body>";
session_start();
ini_set('display_errors', 'On');

//include some extra functions in the php file
include("checklogin.php");
include("HTML_specific.php");

//put out the html code to build the beginnings of the page.
putHeader("Downloads");

//get the username
$username = $_COOKIE["USERNAME"];
//welcome message! :)
echo "<h1>Welcome, " . $username . "!!!</h1>";
//list all the groups the advisor is advising. 
foreach($user_info["years"] as $ayear=>$advisor_groups){
    //say the year for each group.
    echo "<h1> $ayear </h1>";
    //$linkarrs will have a link for each deliverable that has been delivered.
    $linkarrs = Array();
    foreach($advisor_groups as $a){
	//if the group is in the appropriate year, add it as a link.
	//make it as a link. Add GET variables so the downloads.php file knows which files the advisor wants to access.
	$linkarrs[] = makelink("downloads.php?group=" . $a . "&year=" . $ayear, $a);
    }
    //print the groups as an ordered list. 
    makeol($linkarrs);
}

echo "<br />";
echo "<br />";
//home link.
echo "<a href=home.php>home</a>";
echo "<br /><br />";
//logout link.
echo "<a href=logout.php>Logout!</a>";

closeDoc();
?>
