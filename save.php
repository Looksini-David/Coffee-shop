<?php
// Database connection parameters
$servername = "localhost"; // Replace with your server name
$username = "root";         // Replace with your MySQL username
$password = "";             // Replace with your MySQL password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS Customer_Details";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("Customer_Details");

// Create table
$sql_create_table = "CREATE TABLE IF NOT EXISTS Customer (
    Name VARCHAR(100),
    Email VARCHAR(200),
    Phone_Number VARCHAR(50),
    Message VARCHAR(100)
)";
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table Customer created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to MySQL database
    $mysqli = new mysqli("localhost", "root", "", "Customer_Details");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } 

    // Get data from form
    $Name = $_POST['Name'];
    $Phone= $_POST['Phone_Number'];
    $Email = $_POST['Email'];
    $Message= $_POST['Message'];

    // Prepare SQL statement
    $sql = "INSERT INTO Customer (Name, Email, Phone_Number, Message) VALUES ('$Name', '$Email', '$Phone', '$Message')";

    // Execute SQL statement
    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
}

// Query to retrieve data
$conn = new mysqli($servername, $username, $password, "Customer_Details");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Name, Phone_Number, Email, Message FROM Customer";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table><tr><th>Name</th><th>Phone Number</th><th>Email</th><th>Message</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Phone_Number"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Message"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
