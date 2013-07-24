<?php

session_start();
//next line for safari to not hang. woosh!

echo "
<form action=\"upload_file.php\" method=\"post\"
enctype=\"multipart/form-data\">
<label id=\"filetype\" for=\"file\"></label><br />
<input type=\"file\" name=\"file\" id=\"file\" /> 
<br />
";
//echo "<select name=\"deliverable\">";

$username = $_COOKIE["USERNAME"];
//$user_info = unserialize($_COOKIE["USER_INFO"]);


//get basic information about user so that we can get the directory they are uploading to.
//$year = $_COOKIE["year"];
//$groupname = $_COOKIE["groupname"];
$dir = getDir($year, $groupname);
$docs = listDir($dir);

//get the list of deliverables that can be uploaded.
$components = parse_ini_file($dir . "/components.ini", true);
$component_names = Array();
//get a list of the deliverable names
foreach($components as $name=>$stuff){
    array_push($component_names, $name);
}

//put them in a pull-down menu thing.
/*foreach($component_names as $a){
    echo "<option value=\"" . $a . "\">" . $a . "</option>";
    echo "\n";
}
echo "</select>";
 */
pulldown($component_names, "deliverable", "OnChange();");

?>
	    <input type="submit" name="submit" value="Submit" />
	</form>

<?php

$allowedExts = array();
//get a list of the deliverable names
echo "<script language=\"javascript\">\n";
echo "<!--\n";
echo "
    function OnChange()\n
    { 
    
	var Components = [\n";
	foreach($component_names as $comp){
	    $allowedExts = implode(", ", explode(",",$components[$comp]["doctypes"]));
	    if($allowedExts=="")
		$allowedExts="Any filetype is allowed.";

	    echo "\t" . "\"$allowedExts\",\n";
	}
	echo "]
	var dropdown = document.getElementById(\"deliverable\");
	var selIndex = dropdown.selectedIndex
	document.getElementById(\"filetype\").innerHTML = \" Allowed Extensions: \" + Components[selIndex];\n";
	/*$firstComp = array_shift(array_values($component_names));
	$firstAllowed = implode(", ", 
	    explode(",",$component_names[$firstComp]["doctypes"]));
	 */
	echo "\n}

	OnChange();

</script>";

?>

