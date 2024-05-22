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
    <div class="summary">
        <div class="form">
            <form action="#" method="post" class="flex" id="filter">
                <select name="categories" id="category">
                    <option value="default" disabled selected>Choose one category below</option>
                    <option value="all">All</option>
                    <option value="incomplete">incomplete</option>
                    <option value="overpaid">overpaid</option>
                    <option value="complete"></option>
                </select>
                <button type="submit" name="filter">filter</button>
            </form>
        </div>
        <div class="results">
            <div class="result flex">
                <span>Email</span><span>State</span><span>Amount</span><span>Means</span>
            </div>
            <?php

            if (isset($_POST['filter'])) {
            $cat = strtolower($_POST['categories']);

            if ($cat == 'all') {
                $sql = "select * from fees";
            }else if ($cat == "incomplete" || $cat == "overpaid" | $cat == "complete") {
                $sql = "select * from fees where state ='$cat'";

            }
            $result= $conn->query($sql);
            if(!$result) {
                die("error : ". $conn->error);
            }
            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            ?>
            <div class="result flex">
                <span class="email"><?php echo $row['email']; ?></span><span class="state"><?php echo $row['state']; ?></span><span class="amount">ksh . <?php echo $row['paidfee']; ?></span> 
                <span class="means"><?php echo $row['means']; ?></span>
            </div>
            <?php
            }
        }
    }
            ?>
            <div class="form"> 
                <a href="transactions.php" class="btn-main btn width">Go back</a>
            </div>
        </div>
    </div>
</body>
</html>