<?php
// LAB-04/variables_scope.php

// A2: Datatypes to Use
$stringVar = "Welcome to the Music & Arts Department!";
$intVar = 25;
$floatVar = 99.99;
$boolVar = true;
$arrayVar = array("Classical", "Vocal", "Dance", "Instruments");

echo "<h2>PHP Datatypes & Variable Scope</h2>";
echo "<strong>String:</strong> " . $stringVar . "<br>";
echo "<strong>Integer:</strong> " . $intVar . "<br>";
echo "<strong>Float:</strong> " . $floatVar . "<br>";
echo "<strong>Boolean:</strong> " . ($boolVar ? 'true' : 'false') . "<br>";
echo "<strong>Array (first element):</strong> " . $arrayVar[0] . "<br><hr>";

// A3: Variable Scope
$globalCount = 10; // Global Scope

function testScope() {
    // 1. Local Scope
    $localVar = "I am a local variable inside the function.";
    
    // 2. Global Scope (Accessed using 'global' keyword)
    global $globalCount;
    $globalCount += 5; 
    
    // 3. Static Scope
    static $staticCount = 0;
    $staticCount++;
    
    echo "<strong>Local Scope:</strong> $localVar <br>";
    echo "<strong>Global Scope (modified):</strong> $globalCount <br>";
    echo "<strong>Static Scope:</strong> $staticCount (Retains value across calls) <br><br>";
}

// Call function multiple times to observe static scope behavior
echo "<h3>Testing Scopes (Function Calls)</h3>";
print "<strong>Call 1:</strong><br>";
testScope();
print "<strong>Call 2:</strong><br>";
testScope();
print "<strong>Call 3:</strong><br>";
testScope();
?>
