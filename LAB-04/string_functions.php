<?php
// LAB-04/string_functions.php

echo "<h2>Mandatory PHP String Functions Output</h2>";

// B2: String Source
$hardcodedStr = "  hello beautiful world of traditional music  ";
$dbExampleStr = "USER@Example.Com";

echo "<h3>Original Strings</h3>";
echo "Str 1: '$hardcodedStr'<br>";
echo "Str 2: '$dbExampleStr'<br><hr>";

// Basic String Functions
echo "<h3>Basic String Functions</h3>";
echo "<strong>strlen():</strong> Length of Str 1 is " . strlen($hardcodedStr) . "<br>";
echo "<strong>str_word_count():</strong> Word count of Str 1 is " . str_word_count($hardcodedStr) . "<br>";
echo "<strong>strrev():</strong> Reverse of 'music' is " . strrev("music") . "<br>";

// Case Conversion
echo "<h3>Case Conversion</h3>";
echo "<strong>strtoupper():</strong> " . strtoupper($hardcodedStr) . "<br>";
echo "<strong>strtolower():</strong> " . strtolower($dbExampleStr) . "<br>";
echo "<strong>ucfirst():</strong> " . ucfirst(trim($hardcodedStr)) . "<br>";
echo "<strong>ucwords():</strong> " . ucwords(trim($hardcodedStr)) . "<br>";

// Search & Replace
echo "<h3>Search & Replace</h3>";
echo "<strong>strpos():</strong> Position of 'world' in Str 1 is " . strpos($hardcodedStr, 'world') . "<br>";
echo "<strong>str_replace():</strong> " . str_replace("traditional", "classical", $hardcodedStr) . "<br>";

// Substring & Trimming
echo "<h3>Substring & Trimming</h3>";
echo "<strong>substr():</strong> First 5 chars of trimmed Str 1 is '" . substr(trim($hardcodedStr), 0, 5) . "'<br>";
echo "<strong>trim():</strong> '" . trim($hardcodedStr) . "'<br>";
echo "<strong>ltrim():</strong> '" . ltrim($hardcodedStr) . "'<br>";
echo "<strong>rtrim():</strong> '" . rtrim($hardcodedStr) . "'<br>";

// String Comparison
echo "<h3>String Comparison</h3>";
$compare1 = "music";
$compare2 = "MUSIC";
echo "Comparing '$compare1' and '$compare2':<br>";
echo "<strong>strcmp() [case-sensitive]:</strong> " . strcmp($compare1, $compare2) . "<br>";
echo "<strong>strcasecmp() [case-insensitive]:</strong> " . strcasecmp($compare1, $compare2) . "<br>";

// Special Characters & Security
echo "<h3>Special Characters & Security</h3>";
$htmlStr = "<script>alert('hack');</script>";
echo "<strong>htmlspecialchars():</strong> " . htmlspecialchars($htmlStr) . "<br>";
echo "<strong>addslashes():</strong> " . addslashes("O'Neil") . "<br>";

?>
