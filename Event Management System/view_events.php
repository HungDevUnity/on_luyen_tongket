<?php include 'connect.php'; ?>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Date</th>
    <th>Location</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM events");

if ($result->num_rows == 0) {
    echo "No events found in the system.";
}

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['event_name']}</td>
        <td>".date("F d, Y", strtotime($row['event_date']))."</td>
        <td>{$row['location']}</td>
        <td>{$row['status']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Edit</a>
            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>