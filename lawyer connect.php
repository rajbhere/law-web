
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    $conn = new mysqli("localhost", "root", "", "law_firm");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collecting form data safely
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    $specialization = $conn->real_escape_string($_POST['specialization'] ?? '');
    $experience_years = (int)($_POST['experience_years'] ?? 0);

    // Insert into DB
    $sql = "INSERT INTO lawyer (name, email, phone, specialization, experience_years)
            VALUES ('$name', '$email', '$phone', '$specialization', $experience_years)";

    if ($conn->query($sql) === TRUE) {
        echo "<h3 style='color: green; text-align: center;'>Lawyer registered successfully!</h3>";
    } else {
        echo "<h3 style='color: red; text-align: center;'>Error: " . $conn->error . "</h3>";
    }

    $conn->close();
} else {
    echo "<h3 style='color: orange; text-align: center;'>Form not submitted yet.</h3>";
}
?>
