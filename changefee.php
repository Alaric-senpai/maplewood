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
if(isset($_POST['change'])){
    $amount = $_POST['amount'];

    $sql = "ALTER TABLE `fees` CHANGE `totalfee` `totalfee` INT(50) NOT NULL DEFAULT '$amount';";
    $result = $conn->query($sql);
    if(! $result){
        $_SESSION['record'] = "fees change failed";
    }
    else {
        $_SESSION['state'] = "fees update sucessfull to $amount";
    }
    
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payfees</title>
    <link rel="stylesheet" href="./transactions.css">
</head>
<body>
    <div class="summary grid">
        <form action="#" method="post" id="form">
            <h1>Fees change</h1>
            
            <div class="input-box">
                <label for="amount">Amount in ksh new fees</label> <br>
                <input type="number" name="amount" id="amount">
            </div>
            <div class="btns">
                <button type="submit" name="change" class="btn">Update</button>
                <a href="transactions.php" class="btn">Go back</a>
            </div>
        </form>
        <div class="state">
            <p>
            <?php
                if(isset($_SESSION['record'])){
                    echo $_SESSION['record'];
                    unset($_SESSION['record']);
                }
                if(isset($_SESSION['state'])){
                    echo $_SESSION['state'];
                    unset($_SESSION['state']);
                }
            ?>
            </p>
        </div>
    </div>
</body>
</html>