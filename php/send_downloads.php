<?php
session_start();
include("checklogin.php");
include("general.php");
include("dat.php");
$filename = $_GET["filename"];
$year = $_COOKIE["year"];
$groupname = $_COOKIE["groupname"];
$dir = "../groups/" . $year . "/" . $groupname; 
if($theData  = unserialize(readInfo($groupname, $year))){
}
else
{
    $theData = array();
}
$filetype = $theData[$filename]["extension"];
header("Content-Description: File Transfer");
header('Content-type: applications/octet-stream');
header('Content-Disposition: attachment; filename=' . $year . "_" . $groupname . "_" . $filename . ".". $filetype);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($dir . "/" . $filename));
ob_clean();
flush();
readfile($dir . "/" . $_GET["filename"]);
?>
