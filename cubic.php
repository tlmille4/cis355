<?php
echo '<p>Cubic Equation Results: <br/></p>';
$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$d = $_POST['d'];

echo "A: " . $a . "    B: " . $b . "    C: " . $c . "    D: " . $d;

$Q1 = (2 * $b ** 3 - 9 * $a * $b * $c + 27 * $a ** 2 * $d) ** 2;
//echo $Q1 . '<br/>';
$Q2 = (4 * ($b ** 2 - 3 * $a * $c)) ** 3;
//echo $Q2 . '<br/>';

$Q = (pow($Q1 - $Q2, 0.5));
echo "<br/><br/>Q: " . $Q;
		

$C = pow(($Q + 2 * pow($b, 3) - 9 * $a * $b * $c + 27 * pow($a, 2) * $d) / 2, 1 / 3);

echo "<br/>C: " . $C . '<br/>';

$x = 0 - (($b) / (3 * $a)) - (($C) / (3 * $a)) - ((pow(b, 2) - 3 * $a * $c) / (3 * $a * $C));

echo "<br/>";

echo "X1 = " . $x . '<br/><br/>';
echo "******* PHP SOURCE CODE :   ***************************************************<br/>";
show_source(__FILE__);
?>