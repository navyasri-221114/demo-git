<?php
session_start();
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
$message = ''; $error = '';

if (isset($_GET['download'])) {
    $file = basename($_GET['download']);
    $filepath = $upload_dir . $file;
    if (file_exists($filepath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$file.'"');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath); exit;
    } else { $error = "File not found."; }
}

if (isset($_POST['upload'])) {
    if ($_FILES['fileToUpload']['error'] == 0) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_dir . basename($_FILES['fileToUpload']['name']))) {
            $message = "File uploaded!";
        } else { $error = "Upload failed."; }
    }
}

if (isset($_POST['delete'])) {
    $file = $upload_dir . basename($_POST['filename']);
    if (file_exists($file)) {
        unlink($file); $message = "Deleted.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>File Manager</title><link rel="stylesheet" href="../style.css"></head>
<body>
<nav class="navbar"><a href="../index.html">Home</a></nav>
<div class="main"><div class="content">
<h2>Mini File Manager</h2>
<?php if($message) echo "<p style='color:green'>$message</p>"; ?>
<?php if($error) echo "<p style='color:red'>$error</p>"; ?>
<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="fileToUpload"> <button name="upload">Upload</button>
</form>
<table>
<tr><th>Name</th><th>Size</th><th>Actions</th></tr>
<?php
foreach (scandir($upload_dir) as $f) {
    if ($f !== '.' && $f !== '..') {
        echo "<tr><td>$f</td><td>".filesize($upload_dir.$f)."</td><td><a href='?download=$f'>Download</a> | 
        <form method='POST' style='display:inline'><input type='hidden' name='filename' value='$f'><button name='delete'>Delete</button></form></td></tr>";
    }
}
?>
</table>
</div></div>
</body></html>
