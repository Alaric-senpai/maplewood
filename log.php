<?php
require 'error.php';
require 'db.php';


if (!$conn) {
    die("connection error" . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email= $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=? AND password=?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("connection error" . $conn->error);
    }
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = $row['usertype'];

        if ($row['usertype'] == "admin") {
            header("location:admin.php");
            exit();
        }elseif ($row['usertype'] == "student") {
            header("location:student.php");
            exit();
        }elseif ($row['usertype'] == "principal") {
            header("location:principal.php");
            exit();
        }elseif ($row['usertype'] == "staff") {
            header("location:staff.php");
            exit();
        }elseif ($row['usertype'] == "teacher") {
            header("location:teacher.php");
            exit();
        }elseif ($row['usertype'] == "finance") {
            header("location:finance.php");
            exit();
        }elseif ($row['usertype'] == "management") {
            header("location:managementdash.php");
            exit();
        }elseif ($row['usertype'] == "supervisor") {
            header("location:supervisor.php");
            exit();
        }elseif ($row['usertype'] == "secretary") {
            header("location:secretary.php");
            exit();
        }

    }else{
        $message = "invalid credentials";
        $_SESSION['error'] = $message;
        header("location:login.php");
    }
}

?>
