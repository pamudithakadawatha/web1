<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center>
        <h1>Login</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Enter your email:</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Enter password:</td>
                    <td><input type="text" name="password" required></td>
                </tr>
            </table>
            <br><br>
            <center><input type="submit" value="Submit"></center>
        </form>
    </center>
    <center>
        <p>Create an account? <a href="signup.php">Click here</a></p>
    </center>
    <?php
session_start();

include_once "asset/php/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT user_ID, user_password FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_ID, $hashed_password);

    if ($stmt->num_rows > 0) {
        // Fetch the result
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, create session variable
            $_SESSION['user_ID'] = $user_ID;

            echo "Login successful. Welcome, user ID: " . htmlspecialchars($user_ID) . "!";
            // Redirect to a protected page or user dashboard
             header("Location: index.php");
             exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
</body>
</html>