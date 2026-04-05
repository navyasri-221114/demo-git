<?php
// Task A1: variables_scope.php

// Task A2: Datatypes Implementation
$myString = "Hello PHP Web Lab!"; // string
$myInt = 2026; // integer
$myFloat = 99.95; // float
$myBool = true; // boolean
$myArray = array("PHP", "HTML", "CSS", "JS"); // array

echo "<h2>Part A2: Datatypes Demonstration</h2>";
echo "<strong>String:</strong> $myString <br>";
echo "<strong>Integer:</strong> $myInt <br>";
echo "<strong>Float:</strong> $myFloat <br>";
echo "<strong>Boolean:</strong> " . ($myBool ? 'True' : 'False') . "<br>";
echo "<strong>Array:</strong> " . $myArray[0] . ", " . $myArray[1] . "<br>";


// Task A3: Variable Scope (Mandatory)
echo "<h2>Part A3: Variable Scope Types</h2>";

// 1. Local Scope
function testLocalScope() {
    $localVar = "I exist ONLY inside this function (Local Scope)";
    echo "<em>Inside Function:</em> $localVar <br>";
}
testLocalScope();
// echo $localVar; <-- This would crash the script because $localVar isn't available outside

// 2. Global Scope
$globalVar = "I am a globally scoped variable";
function testGlobalScope() {
    global $globalVar; // Accessing the global variable
    echo "<em>Inside Function:</em> Accessing -> <strong>$globalVar</strong> <br>";
}
testGlobalScope();

// 3. Static Scope
function testStaticScope() {
    // Value retained across multiple function calls
    static $visitorCount = 0;
    $visitorCount++;
    echo "<em>Static Variable value:</em> $visitorCount <br>";
}
// Calling it multiple times to demonstrate it retaining its value!
testStaticScope();
testStaticScope();
testStaticScope();

?>
