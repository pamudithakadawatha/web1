<?php
// Include the database connection file
include_once "db_connection.php";

// Check if student_ID is set and not empty
if(isset($_POST['student_ID']) && !empty($_POST['student_ID'])) {
    // Escape user inputs to prevent SQL injection
    $student_ID = $conn->real_escape_string($_POST['student_ID']);

    // Prepare and execute SQL query to delete student record
    $sql = "DELETE FROM student WHERE student_ID = '$student_ID'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: ../../index.php");
             exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request. Please provide a student ID.";
}

// Close database connection
$conn->close();
?>
