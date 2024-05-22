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
    $pass = $_POST['fname'];
    $usertype = clean($_POST['type']);

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
        $stmt->bind_param('sssss', $fname, $sname, $email, $usertype,  $pass);
        $stmt->execute();
        if ($usertype == "management") {
            # code...
            $insert = $conn->prepare("insert into management (firstname, lastname, email, position, contact) values(?, ?, ?, ?, ?");
            if (!$insert) {
                # code...
                die("connection error" . $conn->error);
            }
            $insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
            $insert->execute();
            
        }elseif ($usertype == "staff") {
            # code...
            $insert = $conn->prepare("insert into staff (firstname, lastname, email, position, contact) values(?, ?, ?, ?, ?");
            if (!$insert) {
                # code...
                die("connection error" . $conn->error);
            }
            $insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
            $insert->execute();
        }elseif ($usertype == "teacher") {
            # code...
            $insert = $conn->prepare("insert into teachers (firstname, lastname, email, position, contact) values(?, ?, ?, ?, ?");
            if (!$insert) {
                # code...
                die("connection error" . $conn->error);
            }
            $insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
            $insert->execute();
        }elseif ($usertype == "student") {
            # code...
            $insert = $conn->prepare("INSERT INTO students (firstname, lastname, email, contact) values(?, ?, ?, ?");
            if (!$insert) {
                # code...
                die("connection error" . $conn->error);
            }
            $insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
            $insert->execute();
        }elseif ($usertype == "finance") {
            # code...
            $insert = $conn->prepare("insert into finance (firstname, lastname, email, position, contact) values(?, ?, ?, ?, ?");
            if (!$insert) {
                # code...
                die("connection error" . $conn->error);
            }
            $insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
            $insert->execute();
        }
        if ($position == "prefect") {
            # code...
            $insert = $conn->prepare("insert into prefects (firstname, lastname, email, contact) values(?, ?, ?, ?");
            if (!$insert) {
                # code...
                die("connection error" . $conn->error);
            }
            $insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
            $insert->execute();
        }

        header("location:admin.php");

    }
}
?>


ALTER TABLE your_table_name MODIFY position VARCHAR(255) NOT NULL DEFAULT 'default_position_value';





$insert = $conn->prepare("INSERT INTO your_table_name (firstname, lastname, email, position, contact) VALUES (?, ?, ?, ?, ?)");
$insert = $conn->prepare("INSERT INTO your_table_name (firstname, lastname, email, position, contact) VALUES (?, ?, ?, ?, ?)");
$insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
$insert->bind_param('sssss', $fname, $sname, $email, $position, $contact);
$insert->execute();
$insert->execute();







