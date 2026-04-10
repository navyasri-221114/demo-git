<?php
require __DIR__ . '/vendor/autoload.php';
try {
    $client = new MongoDB\Client("mongodb://localhost:27017", ["serverSelectionTimeoutMS" => 2000]);
    $db = $client->i_mongoDB;
    $users = $db->users->find();
    $userData = [];
    foreach ($users as $user) {
        $userData[] = [
            'email' => $user['email'],
            'createdAt' => (isset($user['createdAt']) && $user['createdAt'] instanceof MongoDB\BSON\UTCDateTime) 
                ? $user['createdAt']->toDateTime()->format('Y-m-d H:i:s') 
                : 'Unknown'
        ];
    }
    
    if (count($userData) === 0) {
        echo "No data found inside the collection. The database is empty right now.";
    } else {
        echo "Successfully connected! Here is the data currently stored:\n";
        print_r($userData);
    }
} catch (Exception $e) {
    echo "Connection Failed: " . $e->getMessage() . "\n\n";
    echo "This usually means the MongoDB Community Server is NOT installed or NOT running on your computer.";
}
