<?php
// Database connection
include('db_connect.php');

// Fetch settings
$stmt = $pdo->query("SELECT * FROM Settings LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

// Return settings as JSON
header('Content-Type: application/json');
echo json_encode($settings);
?>
