<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace these values with your database connection details
    $host = "localhost";
    $username = "root";
    $password = ""; // Leave empty if no password is set
    $dbname = "demo";

    $conn = new mysqli($host, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die('Connection Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    }

    if (isset($_POST['signInEmail']) && isset($_POST['signInPassword'])) {
        $signInEmail = $_POST['signInEmail'];
        $signInPassword = $_POST['signInPassword'];

        // Validate and sign in the user
        $sql = "SELECT * FROM users WHERE email = '$signInEmail'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['password'];

            // Verify the password (you may want to use a password hashing library here)
            if (password_verify($signInPassword, $storedPassword)) {
                // Successful sign-in, you can set session variables or redirect the user
                echo "Sign-in successful!";
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    }

    if (isset($_POST['signUpName']) && isset($_POST['signUpEmail']) && isset($_POST['signUpPassword'])) {
        $signUpName = $_POST['signUpName'];
        $signUpEmail = $_POST['signUpEmail'];
        $signUpPassword = $_POST['signUpPassword'];

        // Hash the password (recommended for security)
        $hashedPassword = password_hash($signUpPassword, PASSWORD_DEFAULT);

        // Register a new user
        $sql = "INSERT INTO users (name, email, password) VALUES ('$signUpName', '$signUpEmail', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful, you can set session variables or redirect the user
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (!empty($name) && !empty($email) && !empty($password)) {
        $host = "localhost";
        $username = "root";
        $db_password = "";
        $dbname = "idyllic";

        $conn = new mysqli($host, $username, $db_password, $dbname);

        if (mysqli_connect_error()) {
            die('Connection Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        }

        $sql = "INSERT INTO login (name, email, password) VALUES ('$name', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "Signed Up!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $conn->close();
    } else {
        echo "Fields should not be empty";
    }
}*/
?>
