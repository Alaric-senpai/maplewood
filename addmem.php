<?php
require 'error.php';
require 'db.php';


if (!isset($_SESSION['email'])) {
    header("location:login.php");
}
if ($_SESSION['usertype'] !== "admin") {
    header("location:login.php");
}


if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Function to clean input data
    function clean($data){
        $data = trim($data);
        $data = strtolower($data);
        return $data;
    }

    $fname = $_POST['fname'];
    $sname = $_POST['lname'];
    $email = $_POST['email'];
    $position = $_POST['post'];
    $contact = $_POST['contact'];
    $pass = password_hash($_POST['fname'], PASSWORD_DEFAULT); // Use the correct input field for the password
    $usertype = clean($_POST['type']);

    // Function to validate email
    function validate($data) {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    if (!validate($email)) {
        echo "<script>alert('Invalid email');</script>";
    } else {
        $sql = "INSERT INTO users (firstname, lastname, email, usertype, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Connection error" . $conn->error);
        }
        $stmt->bind_param('sssss', $fname, $sname, $email, $usertype,  $pass); // Bind the password parameter correctly
        $stmt->execute();

        // Prepare and execute queries based on usertype
        if ($usertype == "management" || $usertype == "staff" || $usertype == "teacher" || $usertype == "finance" || $usertype == "supervisor" || $usertype == "secretary") {
            $insert = $conn->prepare("INSERT INTO " . $usertype . " (firstname, lastname, email, position, contact) VALUES (?, ?, ?, ?, ?)");
            $query = "insert into salary (email) VALUES(?)";
            $stmt = $conn->prepare($query);
            if( !$stmt ) {
                die("connection error" . $conn->error);
            }
            if (!$insert) {
                die("connection error" . $conn->error);
            }
            $stmt->bind_param("s", $email);
            $insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
            $stmt->execute();
            $insert->execute();
        } elseif ($usertype == "student") {
            $insert = $conn->prepare("INSERT INTO students (firstname, lastname, email, contact) VALUES (?, ?, ?, ?)");
            $query = "insert into fees (email) VALUES(?)";
            $stmt = $conn->prepare($query);
            if( !$stmt ) {
                die("connection error" . $conn->error);
            }
            if (!$insert) {
                die("connection error" . $conn->error);
            }
            $stmt->bind_param("s", $email);
            $insert->bind_param('ssss', $fname, $sname, $email, $contact); // Removed the 'position' parameter
            $insert->execute();
            $stmt->execute();
        }

        if ($position == "prefect") {
            $insert = $conn->prepare("INSERT INTO prefects (firstname, lastname, email, contact) VALUES (?, ?, ?, ?)");
            if (!$insert) {
                die("connection error" . $conn->error);
            }
            $insert->bind_param('ssss', $fname, $sname, $email, $contact); // Removed the 'position' parameter
            $insert->execute();
        }
        $_SESSION['sucess'] = "user added sucessfully";
        header("location:admin.php");
    }
}

