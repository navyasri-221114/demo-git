<?php
// LAB-05/file_functions_demo.php
// Demonstrating Task 2 (Explore PHP File Functions) and Task 3 (File Operation Modes)

echo "<h1>PHP File Functions & Operation Modes Demo</h1>";

// --- FILE CREATION & MODES (Task 3) ---
echo "<h2>1. File Operation Modes</h2>";

$demo_file = 'demo_test_file.txt';

// Mode 'w' : Write only (erase old data or create new)
$fh = fopen($demo_file, 'w');
fwrite($fh, "Hello this is the first line written with mode 'w'.\n");
fclose($fh);
echo "File created and written using mode 'w' (Write).<br>";

// Mode 'a' : Append only
$fh = fopen($demo_file, 'a');
fwrite($fh, "This second line is appended using mode 'a'.\n");
fclose($fh);
echo "File appended using mode 'a' (Append).<br>";

// Mode 'r' : Read only
echo "<strong>Reading File using mode 'r':</strong><br>";
$read_fh = fopen($demo_file, 'r');
while(!feof($read_fh)){
    echo fgets($read_fh) . "<br>";
}
fclose($read_fh);


// --- FILE READ/WRITE FUNCTIONS (Task 2) ---
echo "<h2>2. File Read/Write Shortcuts</h2>";
$content1 = file_get_contents($demo_file);
echo "<strong>file_get_contents():</strong><pre>$content1</pre>";

file_put_contents($demo_file, "Line added by file_put_contents.\n", FILE_APPEND);
echo "Appended via <strong>file_put_contents()</strong>.<br>";

$file_array = file($demo_file);
echo "<strong>file()</strong> reads into an array. First line is: " . $file_array[0] . "<br>";


// --- FILE INFORMATION (Task 2) ---
echo "<h2>3. File Information</h2>";
echo "<strong>file_exists():</strong> " . (file_exists($demo_file) ? 'Yes' : 'No') . "<br>";
echo "<strong>filesize():</strong> " . filesize($demo_file) . " bytes<br>";
echo "<strong>filetype():</strong> " . filetype($demo_file) . "<br>";
echo "<strong>fileatime() (Last Accessed):</strong> " . date("F d Y H:i:s", fileatime($demo_file)) . "<br>";
echo "<strong>filemtime() (Last Modified):</strong> " . date("F d Y H:i:s", filemtime($demo_file)) . "<br>";
echo "<strong>filectime() (Inode Changed):</strong> " . date("F d Y H:i:s", filectime($demo_file)) . "<br>";

// Note: permissions and owners might not show perfectly on Windows servers vs Unix
echo "<strong>fileperms():</strong> " . substr(sprintf('%o', fileperms($demo_file)), -4) . "<br>";
echo "<strong>fileowner():</strong> " . fileowner($demo_file) . "<br>";
echo "<strong>filegroup():</strong> " . filegroup($demo_file) . "<br>";
echo "<strong>fileinode():</strong> " . fileinode($demo_file) . "<br>";


// --- FILE & FOLDER MANAGEMENT (Task 2) ---
echo "<h2>4. File & Folder Management</h2>";
$copy_dest = "copied_demo.txt";

if(copy($demo_file, $copy_dest)) {
    echo "<strong>copy():</strong> File copied successfully.<br>";
}

if(rename($copy_dest, "renamed_demo.txt")) {
    echo "<strong>rename():</strong> File renamed successfully.<br>";
}

if(unlink("renamed_demo.txt")) {
    echo "<strong>unlink():</strong> File deleted successfully.<br>";
}

// Folder creation and deletion
$test_dir = 'test_folder';
if(!is_dir($test_dir)){
    mkdir($test_dir);
    echo "<strong>mkdir():</strong> Directory created.<br>";
}
if(is_dir($test_dir)){
    rmdir($test_dir);
    echo "<strong>rmdir():</strong> Directory removed.<br>";
}

echo "<strong>is_file():</strong> " . (is_file($demo_file) ? 'True' : 'False') . "<br>";
echo "<strong>is_dir():</strong> " . (is_dir('uploads') ? 'True' : 'False') . " (Tested 'uploads' folder)<br>";


// --- DIRECTORY HANDLING (Task 2) ---
echo "<h2>5. Directory Handling & Parsing</h2>";
echo "<strong>getcwd():</strong> " . getcwd() . "<br>";

echo "<strong>scandir() on current folder:</strong><br>";
$files = scandir(getcwd());
print_r(array_slice($files, 0, 5)); // Show first 5 items
echo "...<br><br>";

echo "<strong>opendir() && readdir() && closedir():</strong><br>";
if ($dir = opendir(getcwd())) {
    $count = 0;
    while (($file = readdir($dir)) !== false && $count < 3) {
        echo "Found: $file<br>";
        $count++;
    }
    closedir($dir);
}

// --- FILE LOCKING (Task 2) ---
echo "<h2>6. File Locking (flock)</h2>";
$fh_lock = fopen($demo_file, "r+");
if (flock($fh_lock, LOCK_EX)) {  // Exclusive lock
    fwrite($fh_lock, "Writing while exclusively locked.\n");
    flock($fh_lock, LOCK_UN);    // Release lock
    echo "<strong>flock():</strong> Successfully locked, wrote data, and released.<br>";
} else {
    echo "Error securing file lock.<br>";
}
fclose($fh_lock);

?>
