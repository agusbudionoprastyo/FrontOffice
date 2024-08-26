<?php
require_once 'koneksi.php';

// Get the room number from the AJAX request
$room = $_GET['room'];

// Sanitize the room number
$room = mysqli_real_escape_string($conn, $room);

// Use the room number in your database query
$query = mysqli_query($conn, "SELECT * FROM FOGUEST WHERE room='$room' AND foliostatus Not In('O','X')");
$data = mysqli_fetch_assoc($query);

// Process the data and return a response
echo json_encode($data);
?>