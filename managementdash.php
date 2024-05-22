<?php

require 'error.php';
require 'db.php';

if (!isset($_SESSION['email'])) {
    // code..
    header("location:login.php");
}
if ($_SESSION['usertype'] !== "management") {
    // code...
    header("location:login.php");
}

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$email = $_SESSION['email'];

$fetch ="select * from users where email = '$email'";

$result = $conn->query($fetch);

$row = $result->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css.php'; ?>
    <link rel="stylesheet" href="./accounts.css">
    <link rel="stylesheet" href="./managementcontent.css">
    <link rel="stylesheet" href="summary.css">

    <title>Maplewood | Management</title>
</head>
<body>
<button type="button" id="menu-t">menu</button>
<div class="container">
    <div class="menu hide" id="main">
        <a href="managementdash.php">
        <h1 class="logo"><span class="text">Maplewood</span></a> <span class="toggle" id="toggle">X</span></h1>

        <ul>
            <?php
            include 'managementbar.php';
            ?>
        </ul>
    </div>
    <div class="content">
        <!-- <h1>user</h1> -->
        <div class="greeting">
            <span class="greet">Good <span id="identify">Morning</span>, <span><?php echo $row['firstname'] ; ?></span></span>
            <span class="time" id="time">
                
            </span>
            <span class="day">
                <?php
                echo date("Y M D d");
                ?>
            </span>
        </div>
        <div class="summary width">
            
        </div>
    </div>
</div>
<script src="./script2.js"></script>
<script src="./script3.js"></script>
</body>
</html>