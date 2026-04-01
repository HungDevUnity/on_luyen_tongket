<?php
include 'connect_db.php';

$phone = $_POST['phone'];
$date = $_POST['date'];

echo "Checking phone availability...";

$result = $conn->query("SELECT * FROM appointments WHERE phone='$phone' AND appointment_date='$date'");

if ($result->num_rows > 0) {
    echo "<span style='color:red'>This phone number has already booked an appointment on this date!</span>";
}
?>