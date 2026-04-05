<?php
session_start();
$upload_dir = 'uploads/';

if (isset($_GET['file'])) {
    $file_name = basename($_GET['file']);
    $file_path = $upload_dir . $file_name;

    if (file_exists($file_path) && is_file($file_path)) {
        // Headers required to force download in PHP
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        
        // Clear system output buffer appropriately
        flush();
        // Read file output to stream
        readfile($file_path);
        
        // Log the download activity using file modes
        $log_file = 'admissions_log.txt';
        if(file_exists($log_file)) {
            $log = fopen($log_file, 'a');
            fwrite($log, "[" . date('Y-m-d H:i:s') . "] Downloaded: $file_name\n");
            fclose($log);
        }
        
        exit;
    } else {
        echo "Error: File does not exist.";
    }
} else {
    echo "Error: No file specified.";
}
?>
