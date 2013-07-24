<?php
session_start();
include("checklogin.php");
header("connection: close");
date_default_timezone_set('America/Los_Angeles');
$username = $_COOKIE["USERNAME"];
$user_info = unserialize($_COOKIE["USER_INFO"]);

include("general.php");
include("dat.php");
//include("extra_functions.php");

$filename = $_POST["deliverable"];
//echo "Filename: $filename\n<br>\n<br>";

//if(array_search(
$year = $_COOKIE["year"];
$groupname = $_COOKIE["groupname"];
$dir = "../groups/" . $year . "/" . $groupname ; 

$everything=false;
$allowedExts = array();
$components = parse_ini_file($dir . "/components.ini", true);
//get a list of the deliverable names
    $allowedExts = explode(",",$components[$_POST["deliverable"]]["doctypes"]);
if(empty($allowedExts[0]))
    $everything=true;
$extension = end(explode(".", $_FILES["file"]["name"]));
if (($_FILES["file"]["size"] < 20000000)
    && (in_array($extension, $allowedExts) || $everything))
{
    if ($_FILES["file"]["error"] > 0)
    {
	echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
	if($theData  = unserialize(readInfo($groupname, $year))){
	}
	else
	{
	    $theData = array();
	}


	//	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	//	echo "Type: " . $_FILES["file"]["type"] . "<br />";
	//	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	//commented out because I don't think we should tell them of the temp file. That's just asking for trouble.
	//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

	$filebroke = explode(".",$_FILES["file"]["name"]);

	$theData[$_POST["deliverable"]]["extension"] = end($filebroke);
	$theData[$_POST["deliverable"]]["date"] = date('l jS \of F Y h:i:s A');
	$theData[$_POST["deliverable"]]["user"]=$_COOKIE["USERNAME"];


	$username = $_COOKIE["USERNAME"];
	//$compts_ini = parse_ini_file("../components.ini", true);
	$status = $user_info["status"];
	$docs = listDir($dir);
	//	    echo "<br />\n\n";

	writeInfo($groupname, $year, serialize($theData));
	if($upload_data = unserialize(readInfo($groupname, $year))){}
	else $upload_data = Array();
	//need to have something that sets basic stuff if it is not there... blah!
	//$upload_data[$_POST["deliverable"]]["filetype"]=
	move_uploaded_file($_FILES["file"]["tmp_name"],
	    $dir . "/" . $_POST["deliverable"]);
	//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	//	    echo "Uploaded Successfully.";
	$redirect = "downloads.php";
	if($status=="advisor")
	    $redirect = $redirect . "?group=$groupname&year=$year";
	header("location: $redirect");
    }
}
else
{
    echo "Invalid file<br />\n";
    if(!in_array($extension, $allowedExts))
	echo "wrong filetype. Your file had extension $extension, but we only allow "
	. implode(", ", $allowedExts) . ".<br />\n";
    echo "\nthe deliverable: " . $_POST["deliverable"] . "<br />\n";
    //$allowedExts = explode(",",$components[$_POST["deliverable"]]["doctypes"]);
    //echo ($_FILES["file"]["size"]);
}


$status = $user_info["status"];
if($status == "student"){
    echo "<br />";

    echo "<a href=home.php>back</a>";
}else if($status == "advisor"){

    echo "<br />";
    echo "<a href=downloads.php?group=$groupname&year=$year>back</a>";

}
//header("Location: ../upload.php");
?>
