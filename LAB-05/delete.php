<?php
session_start();
$upload_dir = 'uploads/';

if (isset($_GET['file'])) {
    $file_name = basename($_GET['file']);
    $file_path = $upload_dir . $file_name;

    // Check if file exists and is indeed a file before unlinking
    if (file_exists($file_path) && is_file($file_path)) {
        if (unlink($file_path)) {
            // Log deletion
            $log_file = 'admissions_log.txt';
            if(file_exists($log_file)) {
                $log = fopen($log_file, 'a');
                fwrite($log, "[" . date('Y-m-d H:i:s') . "] Deleted: $file_name\n");
                fclose($log);
            }
            
            // Redirect back with success (we can use a query parameter for a quick message but redirect is fine)
            header("Location: admissions.php?msg=deleted");
            exit;
        } else {
            echo "Error: Could not delete $file_name.";
        }
    } else {
        echo "Error: File does not exist.";
    }
} else {
    echo "Error: No file specified.";
}
?>
