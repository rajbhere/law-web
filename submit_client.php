<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "law_firm");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("This script only accepts POST requests.");
}

// Collecting form data safely
$name = $conn->real_escape_string($_POST['name'] ?? '');
$email = $conn->real_escape_string($_POST['email'] ?? '');
$phone = $conn->real_escape_string($_POST['phone'] ?? '');
$address = $conn->real_escape_string($_POST['address'] ?? '');
$aadhar_no = $conn->real_escape_string($_POST['aadhar_no'] ?? '');

// Insert into DB
$sql = "INSERT INTO client (name, email, phone, address, aadhar_no)
        VALUES ('$name', '$email', '$phone', '$address', '$aadhar_no')";

if ($conn->query($sql) === TRUE) {
    echo "<h3 style='color: green; text-align: center;'>Client registered successfully!</h3>";
} else {
    echo "<h3 style='color: red; text-align: center;'>Error: " . $conn->error . "</h3>";
}

$conn->close();
?>