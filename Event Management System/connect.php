<?php
$conn = new mysqli("localhost", "root", "", "booking_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255),
    event_date DATE,
    location VARCHAR(255),
    status ENUM('Scheduled','Cancelled','Completed') DEFAULT 'Scheduled'
);