<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
    <?php include_once "navbar.php";?>
    <h1>Welcome to student management system</h1>
    <br>
    <br>
    <table border="3">
        <tr>
            <th>Student ID</th> 
            <th>NIC</th>
            <th>Name</th>
            <th>Address</th>
            <th>Tel no</th>
            <th>Course</th>
            <th>Update/Delete</th>
        </tr>
        <?php
        // Include the database connection file
        include_once "asset/php/db_connection.php";

        // Fetch data from student table
        $sql = "SELECT * FROM student";
        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["student_ID"] . "</td>";
                echo "<td>" . $row["nic"] . "</td>";
                echo "<td>" . $row["srudent_name"] . "</td>";
                echo "<td>" . $row["srudent_address"] . "</td>";
                echo "<td>" . $row["srudent_no"] . "</td>";
                echo "<td>" . $row["srudent_course"] . "</td>";
                echo "<td>";
                // Update button
                echo "<form action='update.php' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='student_ID' value='" . $row["student_ID"] . "'>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
                // Delete button
                echo "<form onsubmit='return confirm(\"Are you sure you want to delete this student?\")' action='asset/php/delete.php' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='student_ID' value='" . $row["student_ID"] . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }

        // Close database connection
        $conn->close();
        ?>
    </table>    
</body>
</html>
