<?php
// Task 3: File Operation Modes Demo
echo "<h2>Task 3: PHP File Operation Modes (fopen modes)</h2>";
echo "This script demonstrates the difference between r, w, a, x, and their + variations.<br><hr>";
$test_file = "modes_demo.txt";

echo "<strong>1. Mode 'w' (Write):</strong> Creates file or erases existing content.<br>";
$f = fopen($test_file, 'w');
fwrite($f, "Initial Data using 'w' mode.\n");
fclose($f);

echo "<strong>2. Mode 'r' (Read):</strong> Opens existing file for reading at start.<br>";
$f = fopen($test_file, 'r');
echo "Result Read: <pre>" . fread($f, filesize($test_file)) . "</pre><br>";
fclose($f);

echo "<strong>3. Mode 'a' (Append):</strong> Adds data directly at the end of the file.<br>";
$f = fopen($test_file, 'a');
fwrite($f, "Appended Data using 'a' mode.\n");
fclose($f);

$f = fopen($test_file, 'r'); // Read back to see changes
echo "Result after 'a': <pre>" . fread($f, filesize($test_file)) . "</pre><br>";
fclose($f);

echo "<strong>4. Mode 'r+' (Read + Write):</strong> Opens for both. Writing here overwrites the original beginning text.<br>";
$f = fopen($test_file, 'r+');
fwrite($f, "OVR"); 
rewind($f); 
echo "Result after 'r+' write: <pre>" . fread($f, filesize($test_file)) . "</pre><br>";
fclose($f);

unlink($test_file);
echo "<br><strong>Demonstration concluded. Test file unlinked safely.</strong>";
?>
