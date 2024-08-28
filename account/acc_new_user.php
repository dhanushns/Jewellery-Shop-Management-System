<?php

include_once 'connection.php';

$status = 0;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retype_password = $_POST['re_type_password'];

    if (!empty($first_name) || !empty($last_name) || !empty($username) || !empty($password) || !empty($retype_password)) {

        $sql_cmd = "select emailId,username from user_accounts";
        $result = $conn->query($sql_cmd);
        if ($result != TRUE) {
            echo "Error while fetching the data";
            exit;
        }

        $row = mysqli_fetch_array($result, MYSQLI_NUM + MYSQLI_ASSOC);
        if ($row != null) {
            foreach ($row as $item) {
                $data[] = ($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp');
            }
            foreach ($data as $user_data) {

                if ($email == $user_data || $username == $user_data) {
                    echo "<script>alert('Email already registerd')</script>";
                    include_once 'sign_up.php';
                    $flag = 0;
                    break;
                } else {
                    $flag = 1;
                }
            }

            if ($flag == 1) {

                if ($password == $retype_password) {

                    if (strlen($password) <= 12 && preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[@,#,%,*,_]/', $password)) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $sql_cmd = "INSERT INTO user_accounts (firstname,lastname,username,emailid,password) VALUES ('$first_name','$last_name','$username','$email','$hashed_password')";
                        if ($conn->query($sql_cmd) != TRUE) {
                            echo "Error creating account: " . $conn->error;
                            exit;
                        }
                        $status = 1;
                        $flag = 1;
                        header('Location:http://localhost/NS_Jewells/account');
                    } else {
                        $flag = 0;
                    }
                    if ($flag == 0) {
                        echo "<script>alert('Password should contain: 1.Alteast one upper case 2.Alteast one lower case 3.Number [0-9] 4.Maximum character less then 12 5.Atleast one spcial character[@,#,*,_]')</script>";
                        include 'sign_up.php';
                    }
                } else {
                    echo "<script>alert('Password does not match')</script>";
                    include 'sign_up.php';
                }
            }
        } else {
            if ($password == $retype_password) {

                if (strlen($password) <= 12 && preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[@,#,%,*,_]/', $password)) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $sql_cmd = "INSERT INTO user_accounts (firstname,lastname,username,emailid,password) VALUES ('$first_name','$last_name','$username','$email','$hashed_password')";
                    if ($conn->query($sql_cmd) != TRUE) {
                        echo "Error creating account: " . $conn->error;
                        exit;
                    }
                    $status = 1;
                    $flag = 1;

                    header('Location:http://localhost/NS_Jewells/account');
                } else {
                    $flag = 0;
                }
                if ($flag == 0) {
                    echo "<script>alert('Password should contain: 1.Alteast one upper case 2.Alteast one lower case 3.Number [0-9] 4.Maximum character less then 12 5.Atleast one spcial character[@,#,*,_]')</script>";
                    include_once 'sign_up.php';
                }
            } else {
                echo "<script>alert('Password does not match')</script>";
                include_once 'sign_up.php';
            }
        }
        mysqli_free_result($result);
        mysqli_close($conn);
    }
}