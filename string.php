<?php
$name = "Web Techologies";

echo "today class is ".$name."<br>";
echo 'today class is '.$name."<br>";
echo 'today class is $name'."<br>";
echo "today class is $name<br>";

echo "string length is ".strlen($name)."<br>";
echo "No. of words is ".str_word_count($name)."<br>";

echo "POSITION ".strpos($name, "Tech")."<br>";

$str = "  Hello World from PHP  ";

echo "<h2>PHP String Functions Demo</h2>";

echo "1. Length of string: " . strlen($str) . "<br>";
echo "2. Word count: " . str_word_count($str) . "<br>";
echo "3. Position of 'World': " . strpos($str, "World") . "<br>";
echo "4. Uppercase: " . strtoupper($str) . "<br>";
echo "5. Replace 'World' with 'Everyone': " . str_replace("World", "Everyone", $str) . "<br>";
echo "6. Reverse string: " . strrev($str) . "<br>";

$trimmed = trim($str);
echo "7. After trim(): '" . $trimmed . "'<br>";

$words = explode(" ", $trimmed);
echo "8. Explode string into array:<br>";
print_r($words);
?>
