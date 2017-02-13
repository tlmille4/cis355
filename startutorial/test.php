Zippy Dee <br />
<!-- Codepad.org for syntax help -->
<?php
	#using escape characters
	echo "<strong>Hello World <br />\\What's \"up\"?</strong>";
	#not using escape characters
	echo '<strong>Hello World <br />What\'s up?</strong>';
	
	$a = 1;
	$b = 1.5;
	$c = "hello";
	$d = false;
	$e = array(1, 2, 3, 4, 5);
	#$f = {hello:"hi", world: "globe"};
	$g = null;
	#concat use '.'
	#always put numerics in ()
	echo "<br /> a + b equals: " . ($a + $b); 
	echo "<br />B - C: " . ($b + $c);
	if($c == "hello")
		echo "<br/> Variable C says \"hello\"";
	else
		echo "<br/> Variable C doesn't say \"hello\"";
	
	$digits = "1111111";
	$sum = 0;
	for ($i = 0; $i < strlen($digits); $i++)
	{
		$sum += $digits[$i];
	}
	echo "<br/>The sum of the loop is: " . $sum . "<br/><br/>";
	print_r($e);
	echo "<br/>";
	foreach($e as $key => $value)
	{
		echo $key . " " . $value . "<br/>";
	}
	
?>