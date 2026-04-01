<?php
include 'connect.php';

$id = $_GET['id'];
$conn->query("DELETE FROM events WHERE id=$id");

echo "Event has been successfully deleted from the system.";
?>