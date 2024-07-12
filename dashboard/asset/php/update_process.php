<?php
// Include the database connection file
include_once "db_connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_ID'])) {
    // Retrieve form data
    $student_ID = $conn->real_escape_string($_POST['student_ID']);
    $nic = $conn->real_escape_string($_POST['nic']);
    $student_name = $conn->real_escape_string($_POST['student_name']);
    $student_address = $conn->real_escape_string($_POST['student_address']);
    $student_no = $conn->real_escape_string($_POST['student_no']);
    $student_course = $conn->real_escape_string($_POST['student_course']);

    // Prepare and execute SQL query to update student data
    $sql = "UPDATE student SET nic = '$nic', srudent_name = '$student_name', srudent_address = '$student_address', srudent_no = '$student_no', srudent_course = '$student_course' WHERE student_ID = '$student_ID'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: ../../index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
        header("Location: ../../index.php");
        exit;
    }
} else {
    echo "Invalid request. Please provide student data.";
    header("Location: ../../index.php");
    exit;
}

// Close database connection
$conn->close();
?>
