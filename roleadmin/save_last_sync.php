<?php
session_start();
require_once '../helper/connection.php'; // Memuat file connection.php

// Memeriksa koneksi
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Menyimpan timestamp terakhir sync ke dalam database
$lastSyncTime = $_POST['lastSyncTime'];
$sql = "INSERT INTO last_sync_time (last_sync) VALUES ('$lastSyncTime')";

if ($connection->query($sql) === TRUE) {
    echo "Last sync time saved successfully";
} else {
    echo "Error saving last sync time: " . $connection->error;
}

$connection->close();
?>