<?php

require 'error.php';
require 'db.php';

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
if ($_SESSION['usertype'] !== "teacher") {
    header("location:login.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 1 results</title>
    <link rel="stylesheet" href="select.css">
    <link rel="stylesheet" href="resview.css">
</head>
<body>
    <div class="form">
        <form action="#" method="post">
            <select name="term" id="term">
                <option value="#" selected disaled>Select term to display results</option>
                <option value="all">All terms</option>
                <option value="1">Term 1</option>
                <option value="2">Term 2</option>
                <option value="3">Term 3</option>
            </select>
            <button type="submit" name="filter">Filter</button>
        </form>
    </div>
    <div class="results">
        <table>
            <tr>
                <th>Rank</th>
                <th>Email</th>
                <th>total</th>
                <th>average</th>
                <th>remarks</th>
            </tr>
            <?php
            if(isset($_POST["filter"])){
                // echo "helo charles";
                $term = $_POST['term'];
                if($term == 'all'){
                    $sql = "select * from exams order by total DESC";
                }else{
                $sql = "select * from exams where term='$term' order by total DESC";
                }
                $result = mysqli_query($conn, $sql);
                 if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                     while ($row = mysqli_fetch_assoc($result)) {
                        
                        if($row['average'] >= 80){
                            $remark = "Excellent";
                        }elseif($row['average'] >= 60){
                            $remark = "Good job";
                        }elseif($row['average'] >= 50){
                            $remark = "Average";
                        }elseif($row['average'] >= 30){
                            $remark = "Poor";
                        }else{
                            $remark = "FAIL";
                        }
                     
             

            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['average']; ?></td>
                <td><?php echo $remark; ?></td>
            </tr>
            <?php
                     }
                     $i++;
                    }
                
                }
            ?>
        </table>
    </div>
    <div class="btns">
        <a href="select.php">Go back</a>
    </div>
</body>
</html>