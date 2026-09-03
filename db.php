<?php
$conn = new mysqli("localhost", "root", "", "fitness_store1");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>