<?php
$conn = new mysqli("localhost", "root", "", "booking");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

CREATE DATABASE booking_db;
USE booking_db;

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255),
    phone VARCHAR(20),
    appointment_date DATE,
    notes TEXT,
    send_sms TINYINT DEFAULT 0
);