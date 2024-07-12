<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php include_once "navbar.php";?>
    <h1>Welcome to Student Management System</h1>
    <br>

    <!-- Search Form -->
    <form method="post" action="">
        <label for="search_query">Search Students:</label><small> (Search by NIC, Name, Address, Tel no, Course)</small>
        <input type="text" id="search_query" name="search_query">
        <input type="submit" value="Search">
    </form>
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

        // Initialize the query for fetching data
        $sql = "SELECT * FROM student";

        // Check if search form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['search_query'])) {
            $search_query = $conn->real_escape_string($_POST['search_query']);
            $sql .= " WHERE nic LIKE '%$search_query%' OR srudent_name LIKE '%$search_query%' 
                    OR srudent_address LIKE '%$search_query%' OR srudent_no LIKE '%$search_query%' 
                    OR srudent_course LIKE '%$search_query%'";
        }

        // Fetch data from student table
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
            echo "<tr><td colspan='7'>No results found</td></tr>";
        }

        // Close database connection
        $conn->close();
        ?>
    </table>    
</body>
</html>
