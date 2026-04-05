<?php
echo "<h2>Task 2: PHP File Functions Demonstration</h2>";
$filename = "sample_log_task2.txt";

echo "<h3>1. File Write & Read</h3>";
$file = fopen($filename, "w+");
fwrite($file, "Hello! This is a test log for AI tools.\nSecond line of the log.\n");
rewind($file);
$size = filesize($filename);
$content = fread($file, $size);
fclose($file);
echo "<strong>File Content Read:</strong><br><pre>$content</pre>";

echo "<h3>2. Easy Reading & Writing</h3>";
file_put_contents($filename, "Appending text via file_put_contents.\n", FILE_APPEND);
$easy_read = file_get_contents($filename);
echo "<strong>Read via file_get_contents:</strong><br><pre>$easy_read</pre>";

echo "<h3>3. File Information Functions</h3>";
if(file_exists($filename)) {
    echo "Filesize: " . filesize($filename) . " bytes<br>";
    echo "Filetype: " . filetype($filename) . "<br>";
    echo "Last Modified Time (filemtime): " . date("Y-m-d H:i:s", filemtime($filename)) . "<br>";
}

echo "<h3>4. Directory Handling & Parsing</h3>";
echo "Current Directory (getcwd): " . getcwd() . "<br>";
$files = scandir(".");
echo "<strong>Scandir Method:</strong><br>";
foreach($files as $f) { if($f != '.' && $f != '..') echo "- " . $f . "<br>"; }

unlink($filename);
?>
