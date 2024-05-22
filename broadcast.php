<?php

// ini_set("display_erors, 1");

require 'error.php';
require 'db.php';

if (!isset($_SESSION['email'])) {
    // code..
    header("location:login.php");
}
if ($_SESSION['usertype'] !== "admin") {
    // code...
    header("location:login.php");
}


if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css.php'; ?>
    <link rel="stylesheet" href="./accounts.css">
    <link rel="stylesheet" href="managementcontent.css">
    <link rel="stylesheet" href="results.css">
    <!-- <link rel="stylesheet" href="management.css"> -->
    <link rel="stylesheet" href="summary.css">
    <!-- <link rel="stylesheet" href="admin.css"> -->

    <title>Maplewood | Admin</title>
</head>
<body>
<button type="button" id="menu-t">menu</button>
<div class="container">
    <div class="menu hide" id="main">
        <a href="admin.php">
        <h1 class="logo"><span class="text">Maplewood</span></a> <span class="toggle" id="toggle">X</span></h1>

        <ul>
            <?php
            include 'sidebar.php';
            ?>
        </ul>
    </div>
    <div class="content">
        <!-- <h1>user</h1> -->
        <div class="greeting">
        <span class="greet">Good <span id="identify">Morning</span>, <span><?php echo $row['firstname'] ; ?></span></span>
        <span class="time" id="time"></span>
            <span class="day">
                <?php
                echo date("Y M D d");
                ?>
            </span>
        </div>
        
            <form action="broad.php" method="post">
                <div class="input-box">
                    <label for="sender">
                        sender
                    </label>
                    <input type="email" name="sender" id="sender">
                </div>
                <div class="input-box">
                    <label for="content">Message</label>
                    <!-- <input type="text" name="content" id="content"> -->
                    <textarea name="message" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="input-box">
                    <label for="recepient">recepient</label>
                    <select name="recepient" id="recepient">
                        <option value="all">all</option>
                        <option value="teachers">teachers</option>
                        <option value="staff">staff</option>
                        <option value="management">management</option>
                        <option value="students">students</option>
                        <option value="finance">finance</option>
                        <option value="prefects">prefects</option>
                    </select>
                </div>
                <div class="input-box">
                    <button type="submit" name="send">Broadcast</button>
                </div>
            </form>
</div>
<script src="./script2.js"></script>
<script src="./script3.js"></script>
</body>
</html>

