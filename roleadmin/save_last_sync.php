<?php
session_start();
require_once '../helper/connection.php'; // Memuat file connection.php

// Memeriksa koneksi
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Memvalidasi dan menyiapkan data input
$lastSyncTime = $_POST['lastSyncTime'];

// Prepared statement untuk menyimpan timestamp terakhir
$sql = "INSERT INTO last_sync_time (last_sync) VALUES (?)";

$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $lastSyncTime);

// Eksekusi statement
if ($stmt->execute()) {
    echo "Last sync time saved successfully";
} else {
    echo "Error saving last sync time: " . $stmt->error;
}

// Menutup statement dan koneksi
$stmt->close();
$connection->close();
?>
