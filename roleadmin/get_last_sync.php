<?php
session_start();
require_once '../helper/connection.php'; // Memuat file connection.php

// Memeriksa koneksi
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Mengambil timestamp terakhir sync dari database
$sql = "SELECT last_sync FROM last_sync_time ORDER BY id DESC LIMIT 1";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastSyncTime = $row['last_sync'];
    echo json_encode(array('lastSyncTime' => $lastSyncTime));
} else {
    echo json_encode(array('lastSyncTime' => null));
}

$connection->close();
?>
