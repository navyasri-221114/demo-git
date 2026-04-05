<?php
// Task B1: string_functions.php

echo "<h2>Part B: String Functions Implementation</h2>";

// Task B2: String Source (Hardcoded and User Input)
$exampleHardcoded = "   the quick brown fox jumps over the LAZY dog   ";
$userInput = isset($_POST['user_text']) ? $_POST['user_text'] : "sample test input";

echo "<strong>Hardcoded String:</strong> '$exampleHardcoded'<br>";
echo "<strong>User Input String:</strong> '$userInput'<br><br>";

// Task B3: Mandatory String Functions

echo "<h3>1. Basic String Functions</h3>";
echo "<strong>strlen():</strong> Length of input is " . strlen($userInput) . " characters.<br>";
echo "<strong>str_word_count():</strong> Input has " . str_word_count($userInput) . " words.<br>";
echo "<strong>strrev():</strong> Reversed input: " . strrev($userInput) . "<br>";


echo "<h3>2. Case Conversion</h3>";
echo "<strong>strtoupper():</strong> " . strtoupper($userInput) . "<br>";
echo "<strong>strtolower():</strong> " . strtolower($userInput) . "<br>";
echo "<strong>ucfirst():</strong> " . ucfirst($userInput) . "<br>";
echo "<strong>ucwords():</strong> " . ucwords($userInput) . "<br>";


echo "<h3>3. Search & Replace</h3>";
$position = strpos($exampleHardcoded, "fox");
echo "<strong>strpos():</strong> Found 'fox' at index " . ($position !== false ? $position : "Not found") . " in hardcoded string.<br>";
echo "<strong>str_replace():</strong> " . str_replace("dog", "cat", $exampleHardcoded) . "<br>";


echo "<h3>4. Substring & Trimming</h3>";
$cleanedHardcoded = trim($exampleHardcoded);
echo "<strong>trim():</strong> '" . $cleanedHardcoded . "'<br>";
echo "<strong>ltrim():</strong> '" . ltrim($exampleHardcoded) . "'<br>";
echo "<strong>rtrim():</strong> '" . rtrim($exampleHardcoded) . "'<br>";
echo "<strong>substr():</strong> Extracting first 9 chars of cleaned string: " . substr($cleanedHardcoded, 0, 9) . "<br>";


echo "<h3>5. String Comparison</h3>";
$compare1 = "apple";
$compare2 = "APPLE";
echo "Comparing '$compare1' and '$compare2':<br>";
echo "<strong>strcmp() (Case-Sensitive):</strong> " . strcmp($compare1, $compare2) . " (Returns non-zero, they don't match exactly)<br>";
echo "<strong>strcasecmp() (Case-Insensitive):</strong> " . strcasecmp($compare1, $compare2) . " (Returns 0, they match!)<br>";


echo "<h3>6. Special Characters & Security</h3>";
$hackedInput = "<script>alert('XSS Hack');</script> O'Connor";
echo "<strong>Raw Unsafe String:</strong> $hackedInput<br>";
echo "<strong>htmlspecialchars():</strong> " . htmlspecialchars($hackedInput) . "<br>";
echo "<strong>addslashes():</strong> " . addslashes($hackedInput) . "<br>";

?>
<hr>
<!-- Form for User Input Testing -->
<form method="POST">
    <label>Test your own string input:</label><br>
    <input type="text" name="user_text" required value="<?php echo htmlspecialchars($userInput); ?>" style="width: 300px;"><br><br>
    <button type="submit">Submit Input</button>
</form>
