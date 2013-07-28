<?php


//return an array listing the contents of the directory passed in.
//this functino excludes hidden documents (like ./, ../, as well as .swp files.)
function listDir($dir)
{
    $docs = Array();
    //echo $dir;
    if($handle = opendir($dir)){
	$i=0;
	while(false !== ($docs[$i]=readdir($handle))){
	    if($docs[$i] != "." && $docs[$i] != "..")// && !strpos($docs[$i], ".swp"))
	    {	$i++;
	    }
	}
	closedir($handle);
    }	
    return $docs;
}




function listDirTest($dir)
{
    $docs = Array();
    //echo $dir;
    if($handle = opendir($dir)){
	$i=0;
	while(false !== ($docs[$i]=readdir($handle))){
	    if($docs[$i][0] != ".")// && !strpos($docs[$i], ".swp"))
	    {	$i++;
	    }
	}
	closedir($handle);
    }	
    return $docs;
}


//authenticates with the Groupwise server
function Novell_authentication($username, $password)
{
    $authenticated = FALSE;
    $file = fsockopen("tcp://pop.scu.edu",110);

    if(strpos(fgets($file), "+OK") === 0)
    {	
	fputs($file,"USER $username\n");
	if(strpos(fgets($file), "+OK") === 0)
	{
	    fputs($file,"PASS $password\n");
	    if(strpos(fgets($file), "+OK") === 0)
	    {
		$authenticated=TRUE;
	    }
	}
    }
    
    //since the school has since changed its email server (it no longer uses Groupwise), this is a crude backdoor
    if($username=="qgeorge" && $password=="imaprettyprincess")
	$authenticated=TRUE;
    fclose($file);
    return $authenticated;
}

function getDir($year, $group){
    return "../groups/$year/$group";
}

?>
