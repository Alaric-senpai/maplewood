<?php

require 'error.php';
require 'db.php';
if (!isset($_SESSION['email'])) {
    // code..
    header("location:login.php");
}
if ($_SESSION['usertype'] !== "finance") {
    // code...
    header("location:login.php");
}




if(!$conn){
    die('connection error' . $conn->connect_error);
}
if(isset($_POST['pay'])){
    $email = $_POST['email'];
    $amount = $_POST['amount'];

    $sql = "select * from students where email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $fees = $conn->query("select * from fees");
        $cash = $fees->fetch_assoc();
        $means = $_POST['means'];
        if(!$fees){
            die("connection error". $conn->connect_error);
        }
        $total = $cash['totalfee'];
        if($amount < $total){
            $balance = $total - $amount;
            $state = 'incomplete';
            $excess = 0;
            $query = "insert into fees (email, paidfee, totalfee, state, balance, excess, means) values(?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            if(!$stmt){
                die("error" .$conn->error);
            }
            $stmt->bind_param("siisiis", $email, $amount, $total,  $state, $balance, $excess, $means);
            $stmt->execute();
            $_SESSION['state'] = "process was sucessfull";
            header("location:feespay.php");

        }elseif($amount > $total){
            $excess = $amount - $total;
            $state = 'overpaid';
            $balance = 0;
            $query = "insert into fees (email, paidfee, totalfee, state, balance, excess, means) values(?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            if(!$stmt){
                die("error" .$conn->error);
            }
            $stmt->bind_param("siisiis", $email, $amount, $total,  $state, $balance, $excess, $means);
            $stmt->execute();
            $_SESSION['state'] = "process was sucessfull";
            header("location:feespay.php");
        }elseif($amount == $total){
            $balance = $total - $amount;
            $state = 'complete';
            $excess = 0;
            $query = "insert into fees (email, paidfee, totalfee, state, balance, excess, means) values(?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            if(!$stmt){
                die("error" .$conn->error);
            }
            $stmt->bind_param("siisiis", $email, $amount, $total,  $state, $balance, $excess, $means);
            $stmt->execute();
            $_SESSION['state'] = "process was sucessfull";
            header("location:feespay.php");
        }
    }else{
        $_SESSION['record'] = "student does not exist in the database";
        header("location:feespay.php");
    }
}

