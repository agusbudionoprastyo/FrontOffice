<?php
session_start();
require_once '../helper/connection.php'; // Memuat file connection.php

// Memeriksa koneksi
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query untuk mengambil timestamp terakhir sync
$sql = "SELECT last_sync FROM last_sync_time ORDER BY id DESC LIMIT 1";

// Eksekusi query
$result = $connection->query($sql);

// Menangani hasil query
if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastSyncTime = $row['last_sync'];
        echo json_encode(array('lastSyncTime' => $lastSyncTime));
    } else {
        echo json_encode(array('lastSyncTime' => null));
    }
} else {
    echo json_encode(array('error' => 'Error retrieving last sync time: ' . $connection->error));
}

// Menutup koneksi
$connection->close();
?>