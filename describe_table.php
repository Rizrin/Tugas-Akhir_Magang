<?php
$mysqli = new mysqli("localhost", "root", "", "SBU");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$result = $mysqli->query("DESCRIBE usulan");
$fields = [];
while ($row = $result->fetch_assoc()) {
    $fields[] = $row;
}
echo json_encode($fields, JSON_PRETTY_PRINT);
