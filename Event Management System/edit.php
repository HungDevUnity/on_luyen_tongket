<?php
include 'connect.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM events WHERE id=$id");

if ($result->num_rows == 0) {
    die("Event not found in the system!");
}

$row = $result->fetch_assoc();
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $row['event_name'] ?>"><br>
    Date: <input type="date" name="date" value="<?= $row['event_date'] ?>"><br>
    Location: <input type="text" name="location" value="<?= $row['location'] ?>"><br>

    <button type="submit">Update</button>
</form>

<?php
if ($_POST) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    $conn->query("UPDATE events SET 
        event_name='$name',
        event_date='$date',
        location='$location'
        WHERE id=$id");

    echo "Updated successfully!";
}
?>