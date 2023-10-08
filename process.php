<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "idyllic";

    $conn = new mysqli($host, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die('Connection Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    }

    if (isset($_POST['signInEmail']) && isset($_POST['signInPassword'])) {
        $signInEmail = $_POST['signInEmail'];
        $signInPassword = $_POST['signInPassword'];

        $sql = "SELECT * FROM login WHERE email = '$signInEmail'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['password'];

            if ($signInPassword == $storedPassword) {
				header("Location: first.html");
                exit();
            } 
			else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    }

    if (isset($_POST['signUpName']) && isset($_POST['signUpEmail']) && isset($_POST['signUpPassword'])) {
		//if (!empty($i_catg) || !empty($i_name) || !empty($r_name) || !empty($ph_no) || !empty($email_id)) {
        $signUpName = $_POST['signUpName'];
        $signUpEmail = $_POST['signUpEmail'];
        $signUpPassword = $_POST['signUpPassword'];

        // Hash the password (recommended for security)
        //$hashedPassword = password_hash($signUpPassword, PASSWORD_DEFAULT);

        // Register a new user
        $sql = "INSERT INTO login (name, email, password) VALUES ('$signUpName', '$signUpEmail', '$signUpPassword')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful, you can set session variables or redirect the user
			header("Location: first.html");
            exit();
            //echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
	//}

    $conn->close();
}
?>