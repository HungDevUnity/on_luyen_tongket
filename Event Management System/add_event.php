<?php include 'connect.php'; ?>

<form method="POST">
    Event Name: <input type="text" name="name"><br>
    Event Date: <input type="date" name="date"><br>
    Location: <input type="text" name="location"><br>

    Status:
    <select name="status">
        <option value="Scheduled">Scheduled</option>
        <option value="Cancelled">Cancelled</option>
        <option value="Completed">Completed</option>
    </select><br>

    <button type="submit">Add Event</button>
</form>

<?php
if ($_POST) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $status = $_POST['status'] ?: "Scheduled";

    if (empty($name)) echo "Event name is required!<br>";
    elseif ($date <= date("Y-m-d")) echo "Event date must be a future date!<br>";
    elseif (empty($location)) echo "Location is required!<br>";
    else {
        $conn->query("INSERT INTO events(event_name,event_date,location,status)
                      VALUES('$name','$date','$location','$status')");
        echo "Added successfully!";
    }
}
?>