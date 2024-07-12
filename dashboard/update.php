<?php include_once "navbar.php";?>

<?php
// Include the database connection file
include_once "asset/php/db_connection.php";

// Check if student_ID is set and not empty
if(isset($_POST['student_ID']) && !empty($_POST['student_ID'])) {
    // Retrieve student_ID from POST data
    $student_ID = $conn->real_escape_string($_POST['student_ID']);

    // Fetch student data based on student_ID
    $sql = "SELECT * FROM student WHERE student_ID = '$student_ID'";
    $result = $conn->query($sql);

    // Check if student data is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign student data to variables
        $nic = $row["nic"];
        $student_name = $row["srudent_name"];
        $student_address = $row["srudent_address"];
        $student_no = $row["srudent_no"];
        $student_course = $row["srudent_course"];
    } else {
        echo "Student not found";
    }
} else {
    echo "Invalid request. Please provide a student ID.";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>
<body>
  
    <h1>Update Student</h1>
    <form action="asset/php/update_process.php" method="post">
        <input type="hidden" name="student_ID" value="<?php echo $student_ID; ?>">
        <label for="nic">Student NIC:</label>
        <input type="text" id="nic" name="nic" value="<?php echo $nic; ?>" required><br>
        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name" value="<?php echo $student_name; ?>" required><br>
        <label for="student_address">Student Address:</label>
        <input type="text" id="student_address" name="student_address" value="<?php echo $student_address; ?>" required><br>
        <label for="student_no">Student Tel-no:</label>
        <input type="number" id="student_no" name="student_no" value="<?php echo $student_no; ?>" required><br>
        <label for="student_course">Student Course:</label>
        <input type="text" id="student_course" name="student_course" value="<?php echo $student_course; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
