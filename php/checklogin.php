<?php
//the cookies for "USERNAME" and "LOGIN" should be set if the user is logged in. If the cookies are set, do nothing, otherwise the user is not logged in.
if(isset($_COOKIE["USERNAME"])){
}else
{
    echo ('<a href=../index.html>');
    exit("Please Log In");
}	

//this looks at different cookies that should be set if the user has a group. IF NOT you get send to a page that let's you know.
if(!isset($_COOKIE["GROUPS_INI"]) && !isset($_COOKIE["USER_INFO"]))
{
    header("Location: ../nogroup.html");
}
?>
