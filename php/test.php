<?php
$a = array(1,2,3,4);
$b = array(10,20,30);
echo count($a) . "is count(\$a)\n<br />";
$x=$a[count($a)-1];
$y=$b[count($a)-count($b)];
echo "x = $x <br />\n";
echo "y = $y <br />\n";
if($x<$y)
    array_unshift($a,$b);
else
    array_push($a,$b);

print_r($a);
print_r($b);
?>
