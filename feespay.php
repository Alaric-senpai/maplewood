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
        <form action="fees.php" method="post" id="form">
            <h1>Fees payment</h1>
            <div class="input-box">
                <label for="email">Student email</label> <br>
                <input type="email" name="email" id="email">
            </div>
            <div class="input-box">
                <label for="amount">Amount in ksh</label> <br>
                <input type="number" name="amount" id="amount">
            </div>
            <div class="input-box">
                <label for="meand">Means of payment</label> <br>
                <!-- <input type="number" name="amount" id="amount"> -->
                <select name="means" id="means">
                    <option value="KCB BANK">KCB BANK</option>
                    <option value="M-pesa">M-pesa pay</option>
                    <option value="cash">Cash</option>
                </select>
            </div>
            <div class="btns">
                <button type="submit" name="pay" class="btn">Pay</button>
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