<?php
session_start();
include("groups_ini.php");

//get the unsername and password you got from the index.html page.
//username's formatting is changed such that if the user appended "@scu.edu" to their user ID, that is stripped off. 
//the username is also not case sensitive, so that is put to lowercase.
//password is case sensitive, so no changes.
$username = strtolower(explode("@",$_POST['username'])[0]);
$password = $_POST['password'];


$authenticated = Novell_authentication($username, $password);

if (!$authenticated){
    //user is not logged in.
    echo "<a href=\"../index.html\"> 
	Invalid Login.
	</a>";
}
else
{
    //we need to make session variables to show that this person is actually logged in.
    setcookie("USERNAME", $username, time()+3600);
   
    //find the user in the groups.ini file.
    //storage does not happen until later so the user cannot try to access anything if they are not in a group.
    //TODO: MAKE SURE SOMEONE WITHOUT A GROUP SEES NOTHING EVERYWHERE
    $user_info = initialize($username);
    if(isset($user_info["error"])){
	header("Location: ../nogroup.html");
    }else
    if($user_info["status"]==student){
	setcookie("USER_INFO", serialize($user_info), time()+3600);
	header("Location: home.php");
    }
    else
	if($user_info["status"]==advisor){
	    setcookie("USER_INFO", serialize($user_info), time()+3600);
	    header("Location: home.php");
	}
	else
	    header("Location: ../nogroup.html");
    //the user was neither student nor advisor, so should be sent to the nogroup.html page.

}
?>
