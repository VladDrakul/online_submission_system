<?php

//use a for readwrite because it's best. blah. SO MANY ERRORS WAH I GOT IT TO WORK THO YAY
//OK I kind of don't need this, but whatever it's here in case someone wants to try it? blarghldy
function findInfo($dir, $readwrite){
    $docs = listDir($dir);
    if(in_array("components.data", $docs)){
	return fopen($dir . "/components.data", $readwrite);
    }
    else
    {
	return false;
    }
}

//writes dataaaaaa
function writeInfo($groupname, $year, $data){
    $dir = getDir($year,$groupname);
    $filename = $dir . "/components.data";
    $info = fopen($filename, "c");
    fwrite($info, $data);
}

//reads the datazorz
function readInfo($groupname, $year){
    $dir = getDir($year,$groupname);
    $filename = $dir . "/components.data";
    if(file_exists($filename)){
	$info = fopen($filename, "r");
	return fread($info, filesize($filename));
    }
    else return false;
}


?>
