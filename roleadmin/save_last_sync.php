<?php
session_start();
require_once '../helper/connection.php'; // Menggunakan koneksi database

// Memeriksa koneksi
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Waktu saat ini
$syncTime = date('Y-m-d H:i:s');

// Query INSERT untuk memasukkan timestamp baru
$sqlInsert = "INSERT INTO last_sync_time (last_sync) VALUES ('$syncTime')";
$resultInsert = $connection->query($sqlInsert);

if ($resultInsert) {
    echo "Timestamp successfully inserted.";
} else {
    echo "Error inserting timestamp: " . $connection->error;
}

// Menutup koneksi
$connection->close();
?>