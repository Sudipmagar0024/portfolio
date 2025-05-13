<?php
// Database configuration
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'root';
$password = ''; // default is empty for XAMPP

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $email && $message) {
    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute and redirect or show message
    if ($stmt->execute()) {
        echo "✅ Message sent successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "❗ Please fill in all fields.";
}
?>
