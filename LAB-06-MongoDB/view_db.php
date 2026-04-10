<?php 
require __DIR__ . '/vendor/autoload.php'; 
$client = new MongoDB\Client("mongodb://localhost:27017"); 
$db = $client->i_mongoDB; 
$users = $db->users->find(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Viewer Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f1f4f8; margin: 0; padding: 0;}
        .sidebar { height: 100vh; width: 250px; background-color: #001e2b; color: white; position: fixed; top: 0; left: 0; padding-top: 20px;}
        .sidebar h2 { padding-left: 20px; font-size: 18px; color: #00ed64; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { padding: 15px 20px; cursor: pointer; transition: 0.3s; }
        .sidebar ul li:hover, .active { background-color: #02344a; border-left: 4px solid #00ed64; }
        .main-content { margin-left: 250px; padding: 40px; }
        .main-content h1 { color: #001e2b; font-size: 24px; margin-bottom: 20px;}
        .card { background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px;}
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #495057; font-weight: 600; }
        tr:hover { background-color: #f1f4f8; }
        .badge { background-color: #e6fcf5; color: #00875a; padding: 5px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Compass-style DB Viewer</h2>
        <ul>
            <li>Dashboard</li>
            <li>admin</li>
            <li>config</li>
            <li class="active">i_mongoDB</li>
            <li>local</li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Database: i_mongoDB > Collection: users</h1>
        
        <div class="card">
            <h3>Registered Users Data</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID (ObjectId)</th>
                        <th>Email</th>
                        <th>Password (Hashed)</th>
                        <th>Created At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td style="font-family: monospace; color: #666;"><?php echo (string)$user['_id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($user['email']); ?></strong></td>
                        <td style="font-family: monospace; color: #999; font-size: 12px;">Stored Securely</td>
                        <td><?php echo isset($user['createdAt']) ? $user['createdAt']->toDateTime()->format('Y-m-d H:i:s') : 'N/A'; ?></td>
                        <td><span class="badge">Active</span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
