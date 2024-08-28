<?php

include_once 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) || !empty($passsword)) {
        $sql_cmd = "SELECT CAST(CAST(password AS CHAR(10000) CHARACTER SET utf16) AS BINARY) from user_accounts where emailid = '$email'";
        $result = $conn->query($sql_cmd);
        if ($result != TRUE) {
            echo "Error creating database: " . $conn->error;
            exit;
        }

        $row = mysqli_fetch_array($result);
        if ($row != null) {
            if (password_verify($password, $row[0])) {
                echo "<script>alert('Login successfull')</script>";
                session_start();
                $sql_cmd = "SELECT username from user_accounts WHERE emailid = '$email'";
                $username = mysqli_fetch_array($conn->query($sql_cmd), MYSQLI_ASSOC);
                $_SESSION['username'] = $username['username'];
                header("Location:http://localhost/NS_Jewells");
                die();
            } else {
                echo "<script>alert('Invalid username/password')</script>";
                include_once ('./index.html');
            }
        } else {
            echo "<script>alert('Invalid username/password')</script>";
            include_once ('./index.html');
        }
    }
    mysqli_free_result($result);
    mysqli_close($conn);
}