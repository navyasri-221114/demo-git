<?php
if(!is_dir('LAB-04')) {
    mkdir('LAB-04', 0777, true);
}

$files_to_move = [
    'LAB-02/login.php' => 'LAB-04/login.php',
    'LAB-02/register.php' => 'LAB-04/register.php',
    'LAB-02/db_connect.php' => 'LAB-04/db_connect.php'
];

foreach ($files_to_move as $src => $dest) {
    if (file_exists($src)) {
        rename($src, $dest);
        echo "Moved $src to $dest\n";
    }
}
echo "Done.";
?>
