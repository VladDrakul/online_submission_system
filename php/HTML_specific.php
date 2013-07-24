<?php

function putHeader($title){
    $op_head = file("../html_code/open_header.html");
    $cl_head = file("../html_code/close_header.html");
    foreach ($op_head as $a){
	echo $a;
    }
    echo $title;
    foreach ($cl_head as $a){
	echo $a;
    }
}

function closeDoc(){
    $close = file("../html_code/close_doc.html");
    foreach($close as $a){
	echo $a;
    }
}

function printlist($array){
    foreach($array as $a){
	echo "<li>";
	echo $a;
	echo "</li>";
    }
}

//make ordered list (enumerated points)
function makeol($array){
    echo "<ol>";
    printlist($array);
    echo "</ol>";
}

//make unordered list (bullet points)
function makeul($array){
    echo "<ul>";
    printlist($array);
    echo "</ul>";
}

//make check boxe (ONLY 1)
function makecb($name, $value, $text){
    echo "<input type = \"checkbox\" name=\"$name\" value=\"$value\" /> $text <br />";
}

//makes a link
function makelink($link, $text, $extraText = ""){
    return ("<a href=\"" . $link . "\">" . $text . "</a> $extraText\n\n");
}

function pullDown($options, $name, $onchange=""){
    echo "<select id=$name name=$name onchange=\"$onchange\">\n";
    foreach($options as $anOption){
	echo "<option value=\"$anOption\">$anOption</option>\n";
    }
    echo "</select>\n";
}
?>
