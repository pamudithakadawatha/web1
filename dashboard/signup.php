<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <center><h1>Signup</h1>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Enter your username:</td>
                <td><input type="text" name="username" required></td>
            </tr>  
            <tr>
                <td>Enter your email:</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Enter your phone number:</td>
                <td><input type="number" name="phone" required></td>
            </tr>
            <tr>
                <td>Enter your password:</td>
                <td><input type="text" name="password" required></td>
            </tr>
            <tr>
                <td>Re-enter your password:</td>
                <td><input type="text" name="confirm_password" required></td>
            </tr>
        </table>
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
    </center>  
    <center><p>Looking for login? <a href="login.php">Click here</a></p></center>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    $servername = "localhost";
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "student"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize inputs
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_no = mysqli_real_escape_string($conn, $_POST['phone']);
    $user_password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validate passwords
    if ($user_password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Check if email already exists
        $email_check_query = "SELECT * FROM user WHERE user_email = '$user_email' LIMIT 1";
        $result = $conn->query($email_check_query);

        if ($result->num_rows > 0) {
            echo "Email is already registered. Please use a different email.";
        } else {
            // Hash the password
            $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $sql = "INSERT INTO user (user_name, user_email, user_no, user_password) VALUES ('$user_name', '$user_email', '$user_no', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    // Close connection
    $conn->close();
}
?>


    
</body>
</html>