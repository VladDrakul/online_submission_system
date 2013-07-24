<?php


session_start();
header("connection: close");
include("checklogin.php");
include("dat.php");
include("HTML_specific.php");
include("groups_ini.php");

header("connection: close:");

//get user info
$username = $_COOKIE["USERNAME"];
$user_info = unserialize($_COOKIE["USER_INFO"]);

//differentiate between students and advisors for group and year.
if($user_info["status"]==student){

    //need year and groupname to access files.
    //and there should only be one element in the array... I really don't know what the fuck to do here except this.
    foreach($user_info["years"] as $aYear=>$aGroup){
	$year = $aYear;
	$groupname = $aGroup;
    }

    //set the cookies so we can see who the person is later.
    setcookie("year", $year,time()+3600);
    setcookie("groupname", $groupname, time()+3600);
}
else if($user_info["status"]==advisor){

    //need to get which group they're trying to access
    $year = $_GET["year"];
    $groupname = $_GET["group"];

    //check to see if the get variables are valid
    //check

    //set cookies so we know what this user wants for later.
    setcookie("year", $year,time()+3600);
    setcookie("groupname", $groupname, time()+3600);

    //need to do this because advisors came here from a different route. 
}


$teamates = findTeammates($year, $groupname);

//ummmm just because this is so important...? Don't need to do this.

//this just spits out some html... xP
putHeader("Downloads");

//a welcome sign! <3
echo "<h1>Welcome, " . $username . "!!!</h1>";
echo "<h3>Your Team and year:</h3>";
echo $groupname . ", " . $year;
echo "<h3>Your Teammates:</h3>";
//list your team. We should differentiate between students and advisors. TODO: DIFFERENTIATE. BLAH.
echo "<h4>Students</h4>";
$students = $teamates["students"];
$advisors = $teamates["advisors"];
if(count($students)>0)
    makeul($teamates["students"]);
else
    echo "You have no one on your team.";

echo "<h4>Advisors</h4>";
if(count($advisors)>0)
    makeul($teamates["advisors"]);
else
    echo "You have no advisor. Please talk to your administrator.";

$dir = getDir($year, $groupname);
//$dir = "../groups/" . $year . "/" . $groupname ; 
//get all the documents in the directory. 
$docs = listDir($dir);

if(file_exists($dir . "/components.ini")){
    $components = parse_ini_file($dir . "/components.ini", true);
    //i only want the NAMES of the components, no information about them at this point.
    $component_names = Array();
    foreach($components as $name=>$stuff){
	array_push($component_names, $name);
    }
    //now all the names have been gotten.

    if($theData  = unserialize(readInfo($groupname, $year))){
    }
    else
    {
	$theData = array();
    }

    echo "<h3> Click to download: </h3>";
    $linkarrs = $component_names;
    $i = 0;
    foreach($component_names as $a){
	if(in_array($a, $docs)){
	    $theText = "";
	    if(isset($theData[$a])){
		$fileInfo = $theData[$a];
		$theText = $theText 
		    . " Extension: <em>" . $fileInfo["extension"]
		    . "</em>. Uploaded at: <em>" . $fileInfo["date"]
		    . "</em>. Uploaded by: <em>" . $fileInfo["user"]
		    . "</em>";
	    }
	    $linkarrs[$i] = makelink("send_downloads.php?filename=" . $a, $a, $theText);
	}
	else
	{
	    $linkarrs[$i]=$a;
	}
	$i++;
    }

    makeol($linkarrs);

    echo "<br />";

    include("upload.php");
}
else
{
    //there is no components.ini file... uh oh!
    echo "<br />";
    echo "<h1>Please talk to you administrator, for the components.ini file corresponding to your group does not exist.</h1>";
}
if($user_info["status"]==advisor){
    echo "<br /><br />";
    echo "<a href=home.php>Group Page</a>";
}
echo "<br /><br />";
echo "<a href=logout.php>Logout</a>";
echo "<br /><br />";

closeDoc();
?>
