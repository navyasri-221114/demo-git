<?php
session_start();
$upload_dir = 'uploads/';
$log_file = 'admissions_log.txt';
$message = "";

// Ensure upload directory exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Ensure log file exists (Task 3: File Mode 'a' for Appending)
if (!file_exists($log_file)) {
    $file = fopen($log_file, 'w'); // Create new file
    fclose($file);
}

// --- HANDLE UPLOAD ---
if (isset($_POST['upload']) && isset($_FILES['admission_doc'])) {
    $file_name = basename($_FILES['admission_doc']['name']);
    $target_file = $upload_dir . $file_name;
    $file_tmp = $_FILES['admission_doc']['tmp_name'];
    
    // Prevent empty upload completely
    if (!empty($file_name)) {
        if (move_uploaded_file($file_tmp, $target_file)) {
            $message = "<div class='success-msg'>File uploaded successfully!</div>";
            
            // Task 3: File Operations - Logging upload activity
            // 'a+' stands for Read/Append
            $log = fopen($log_file, 'a+');
            $log_entry = "[" . date('Y-m-d H:i:s') . "] Uploaded: $file_name (Size: " . filesize($target_file) . " bytes)\n";
            fwrite($log, $log_entry);
            fclose($log);
        } else {
            $message = "<div class='error-msg'>Failed to upload file.</div>";
        }
    } else {
        $message = "<div class='error-msg'>Please select a file to upload!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Admissions Document Portal</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
    <link rel="stylesheet" href="../LAB-02/style.css">
    <script src="../LAB-02/script.js" defer></script>
    <style>
        .file-manager {
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .file-manager table {
            width: 100%;
            border-collapse: collapse;
            color: white;
            margin-top: 15px;
        }
        .file-manager th, .file-manager td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #444;
        }
        .btn-download { color: #6bf; text-decoration: none; font-weight: bold; }
        .btn-delete { color: #ff6b6b; text-decoration: none; font-weight: bold; margin-left: 10px; }
    </style>
</head>
<body>

<?php include '../LAB-04/header.php'; ?>
<?php include '../LAB-04/navbar.php'; ?>

<div class="main">
    <?php include '../LAB-04/sidebar.php'; ?>

    <div class="content">
        <div class="auth-container" style="max-width: 800px;">
            <h2>Admissions - Document Upload Portal</h2>
            <p>Welcome to the Admissions Portal. Please upload your necessary application documents (ID Proof, Transcripts) safely using the Mini File Manager below.</p>
            
            <?php echo $message; ?>

            <form method="post" action="" enctype="multipart/form-data" class="auth-form" style="background: rgba(255, 255, 255, 0.05); padding: 20px; border-radius: 8px;">
                <div class="form-group">
                    <label>Select Document File</label>
                    <!-- enctype="multipart/form-data" & type="file" -->
                    <input type="file" name="admission_doc" style="border: 1px solid #aaa; padding: 10px; border-radius: 4px; color: white;">
                </div>
                <button type="submit" name="upload" class="primary-btn">Upload Document</button>
            </form>

            <div class="file-manager">
                <h3>Uploaded Documents (File Manager)</h3>
                <table>
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Size (Bytes)</th>
                            <th>Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Task 2: File Manager & Directory Parsing (scandir)
                        $files = scandir($upload_dir);
                        $has_files = false;
                        
                        foreach ($files as $file) {
                            if ($file !== '.' && $file !== '..') {
                                $file_path = $upload_dir . $file;
                                if (is_file($file_path)) {
                                    $has_files = true;
                                    $size = filesize($file_path);
                                    $mtime = date('Y-m-d H:i:s', filemtime($file_path)); // File modification time
                                    
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($file) . "</td>";
                                    echo "<td>$size</td>";
                                    echo "<td>$mtime</td>";
                                    // Linking Download and Delete scripts
                                    echo "<td>
                                        <a href='download.php?file=" . urlencode($file) . "' class='btn-download'>Download</a>
                                        <a href='delete.php?file=" . urlencode($file) . "' class='btn-delete'>Delete</a>
                                    </td>";
                                    echo "</tr>";
                                }
                            }
                        }

                        if (!$has_files) {
                            echo "<tr><td colspan='4'>No documents uploaded yet.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

</body>
</html>
