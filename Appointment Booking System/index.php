<?php include 'connect_db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Booking</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<h2>Appointment Booking Form</h2>

<form method="POST">
    Customer Name: <br>
    <input type="text" name="name"><br>
    <span class="error"><?php echo $nameErr ?? ""; ?></span><br>

    Phone Number: <br>
    <input type="text" name="phone" id="phone"><br>
    <span id="phoneMsg"></span>
    <span class="error"><?php echo $phoneErr ?? ""; ?></span><br>

    Appointment Date: <br>
    <input type="date" name="date"><br>
    <span class="error"><?php echo $dateErr ?? ""; ?></span><br>

    Notes: <br>
    <textarea name="notes"></textarea><br>
    <span class="error"><?php echo $noteErr ?? ""; ?></span><br>

    <input type="checkbox" name="sms"> Send SMS Reminder <br><br>

    <button type="submit">Book Appointment</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // NAME
    $name = trim($_POST["name"]);
    $name = ucwords($name);

    if (empty($name) || !preg_match("/^[a-zA-Z ]{5,}$/", $name)) {
        $nameErr = "Customer Name must contain at least 5 alphabetic characters and no special characters!";
        $valid = false;
    }

    // PHONE
    $phone = $_POST["phone"];
    if (!preg_match("/^0[0-9]{9}$/", $phone)) {
        $phoneErr = "Invalid phone number!";
        $valid = false;
    }

    // DATE
    $date = $_POST["date"];
    if ($date <= date("Y-m-d")) {
        $dateErr = "Appointment date must be a future date!";
        $valid = false;
    }

    // NOTES
    $notes = $_POST["notes"];
    if (strlen($notes) > 500) {
        $noteErr = "Notes must not exceed 500 characters!";
        $valid = false;
    }

    $sms = isset($_POST["sms"]) ? 1 : 0;

    // CHECK PHONE EXISTS
    $check = $conn->query("SELECT * FROM appointments WHERE phone='$phone' AND appointment_date='$date'");
    if ($check->num_rows > 0) {
        $phoneErr = "This phone number has already booked an appointment on this date!";
        $valid = false;
    }

    // INSERT
    if ($valid) {
        $conn->query("INSERT INTO appointments(customer_name, phone, appointment_date, notes, send_sms)
                      VALUES('$name','$phone','$date','$notes','$sms')");
        echo "<p style='color:green'>Your appointment has been successfully booked!</p>";
    }
}
?>

<!-- AJAX CHECK -->
<script>
document.getElementById("phone").addEventListener("keyup", function(){
    let phone = this.value;
    let date = document.querySelector("input[name='date']").value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "check_phone.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        document.getElementById("phoneMsg").innerHTML = this.responseText;
    };

    xhr.send("phone=" + phone + "&date=" + date);
});
</script>

</body>
</html>