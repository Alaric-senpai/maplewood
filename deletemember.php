<?php
require 'error.php';
require 'db.php';

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    # code...
    $userid = $_GET['id'];
    echo $_GET['id'];
    $sql = "delete from users where id  = $userid";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['delete'] = "record deleted sucessfully";
        header("location:admin.php");
    }
    else {
        $_SESSION['fail'] = "delete failed";
        header("location:admin.php");
}
}


?>