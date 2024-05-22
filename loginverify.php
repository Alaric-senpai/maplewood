<?php
require 'error.php';
require 'db.php';

if(!$conn){
    die('connection error'. $conn->connect_error);
}
if(isset($_POST['login'])){
    // echo "sucess";
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $query = "select * from users where email='$email'";
    $result= $conn->query($query);
    if($result->num_rows == 1){
        // echo "another sucess";
        $row = $result->fetch_assoc();
        if(password_verify($pass, $row["password"])){
            $_SESSION['email'] = $row['email'];
            $user = $row['usertype'];
            $_SESSION['usertype'] = $user;
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
    }else{
        $message = "invalid credentials";
        $_SESSION['error'] = $message;
        header("location:login.php");
    }

}