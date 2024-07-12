<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create student</title>
</head>
<body>
    <?php include_once "navbar.php";?>
     <center><h1>
       create student
    </h1>
    <form method="post" action="">
    <table>
        <tr>
            <td><label for="nic">Student NIC:</label></td>
            <td><input type="text" id="nic" name="nic" required></td>
        </tr>  
        <tr>
            <td><label for="student_name">Student Name:</label></td>
            <td><input type="text" id="student_name" name="student_name" required></td>
        </tr>
        <tr>
            <td><label for="student_address">Student Address:</label></td>
            <td><input type="text" id="student_address" name="student_address" required></td>
        </tr>
        <tr>
            <td><label for="student_no">Student Tel-no:</label></td>
            <td><input type="number" id="student_no" name="student_no" required></td>
        </tr>
        <tr>
            <td><label for="student_course">Student Course:</label></td>
            <td><select name="student_course" id="student_course">
                <option value="Diploma In ICT">Diploma In ICT </option>
                <option value="Diploma In Agriculture Science">Diploma In Agriculture Science</option>
                <option value="ICT Beginner Course">ICT Beginner Course</option>
                <option value="Certificate In Graphic Designing">Certificate In Graphic Designing</option>
                <option value="Certificate In Web Designing">Certificate In Web Designing</option>
            </select></td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
</center>  
  



    <?php
// Include the database connection file
include_once "asset/php/db_connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nic = $_POST['nic'];
    $student_name = $_POST['student_name'];
    $student_address = $_POST['student_address'];
    $student_no = $_POST['student_no'];
    $student_course = $_POST['student_course'];

    // Prepare and execute SQL query to insert data into student table
    $sql = "INSERT INTO student (nic, srudent_name, srudent_address, srudent_no, srudent_course) 
            VALUES ('$nic', '$student_name', '$student_address', '$student_no', '$student_course')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

    
</body>
</html>