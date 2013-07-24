<?php
session_start();
echo "<html><head><link rel=\"stylesheet\" type=\"text/css\" href=\"log.css\"</head><body>";
include("extra_functions.php");

//I don't know what this is.
$_SESSION['config_path'] = "config/config.ini";//maybe don't need.

//Nick made this, I just moved it to a different file.
include("checklogin.php");

//
//print_r($_COOKIE);


//This find the username the user used to log in. 
$user_name = $_COOKIE["NOVELL_LGN_USERNAME"];
//print username in a welcome message
echo "<h1>Welcome, " . $_COOKIE["NOVELL_LGN_USERNAME"] . "!!!!</h1>";

//parse the ini file. 
$config = parse_ini_file("../components.ini", true);

//    print_r($config);

//this searches for the name in the config file
$found = false;
foreach($config["user_names"]["names"] as $a){
    if(strtolower($a)==strtolower($user_name))
	$found=true;
    //echo $a . "<br />";
}

if($found){
    //echo "<h2>You are a. . .  " . $config["user_info"][strtolower($user_name)][0] . "</h2>" ;

    $status = $config["user_info"][strtolower($user_name)][0];
    if($status == "student"){


	echo "<a href=../upload.php>Upload your Files!</a>";
	echo "<br /><br />";
	echo "<a href=downloads.php>Download your Files!</a>";
	echo "<br /><br />";
    }
    else if($status == "advisor"){
	echo "you are an advisor... we love you!<br />";
	$groups = explode(",",$config["user_info"][strtolower($user_name)][1]);
	//print_r($groups);
	echo "Your groups: <br />";
	//makeol(makelink("groups.php",$groups[1]));
	echo "<ol><li>" . makelink("groups.php",$groups[1] . ", " .  $groups[0]) . "</li></ol>";
	echo "<br />";

    }

}


//echo "help!";

?>


<!-- 
<div style="font-size: 16px; color:grey">
<?= $_COOKIE[NOVELL_LGN_ATTR]; ?>
</div>
-->

<div style="font-size: 14px;">
<a href="logout.php"> LOGOUT </a>
</div>


</body>
</html>
