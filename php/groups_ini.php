<?php

//$groups = parse_ini_file("../groups.ini", true);
include("general.php");

function initialize($username){
    $user_info = array();
    //precondition: there is only 1 username for each user. 
    $groupsDir = "../groups/";
    $possibleYears = listDirTest($groupsDir);
    $user_info["username"] = $username;

    foreach($possibleYears as $aYear){
	//look for the groups.ini file
	if(!($aYear == "")){
	    $groups_info = parse_ini_file($groupsDir . $aYear 
		. "/groups.ini");
	    //look through the ini file to find the user.
	    if(array_key_exists($username,$groups_info)){
		$user_info["years"][$aYear] = $groups_info[$username];
		if(is_array($groups_info[$username])){
		    $user_info["status"] = "advisor";
		}
		else
		{
		    $user_info["status"] = "student";
		}
	    }
	}
    }
    return $user_info;
}

//group_list is the information from the groups.ini file
//name_of_group is... the name of the group. whoosh! 
function findTeammates($year, $name_of_group){
    $team = Array(Array());

    $groupsDir = "../groups/" . $year;
    $group_list = parse_ini_file($groupsDir . "/groups.ini");
    foreach($group_list as $teamate=>$stats){
	if(is_array($stats)){
	    if(in_array($name_of_group, $stats)){
		$team["advisors"][]=$teamate;
	    }
	} else {
	    if($name_of_group == $stats){
		$team["students"][]=$teamate;
	    }
	}
    }
    return $team;
}

?>
