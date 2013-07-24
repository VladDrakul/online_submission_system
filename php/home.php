<?php

session_start();

//$_SESSION['config_path'] = "config/config.ini";

include("checklogin.php");
include("groups_ini.php");


//$user_info was set to a cookie in the login page, access that info.
$user_info = unserialize($_COOKIE["USER_INFO"]);
if($user_info["status"]==student){
    //we include the downloads.php page thing.
    header("Location: downloads.php");
}

else if($user_info["status"]==advisor){
    //include the groups.php page
    include("groups.php");
}

?>	

