<?php

require 'error.php';
require 'db.php';

if(!$conn){
    die('connection error' . $conn->connect_error);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add report</title>
    <link rel="stylesheet" href="reports.css">
    <link rel="stylesheet" href="alert.css">
</head>
<body class="grid-center">

    <form action="addrep.php" method="post" enctype="multipart/form-data">
        <div class="title">
            <h1>Add report</h1>
        </div>
        <div class="input-box">
            <label for="author">Author email</label>
            <input type="email" name="author" id="author">
        </div>
        <div class="input-box">
            <label for="title">report title</label>
            <input type="text" name="title" id="title">
        </div>
        <div class="input-box">
            <label for="category">Report category</label>
            <select name="category" id="category">
                <option value="inflow">cash inflow</option>
                <option value="outflow">cash outflow</option>
            </select>
        </div>
        <div class="input-box">
            <label for="report">Report file</label>
            <input type="file" name="rep" id="report">
        </div>
        <div class="input-box btns">
            <button type="submit" name="add">
                submit report
            </button>
            <a href="financerecords.php">Go back</a>
        </div>
    </form>
    <div class="alert">
        <?php
        if(isset($_SESSION['error'])){
            echo ''. $_SESSION['error'] .'';
            unset($_SESSION['error']);
        }
        ?>
    </div>
</body>
</html>