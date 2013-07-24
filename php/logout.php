<?php
session_start();
session_destroy();
setcookie("USERNAME","",time()-7200);
header('Location:../index.html');
?>
