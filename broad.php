<?php
require 'error.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    # code...
    $sender = $_POST['sender'];
    $receiver = $_POST['recepient'];
    $message = $_POST['message'];
    $date = date('d/M/Y');

    // echo $sender . ''. $receiver .''. $message .''. $date ;
    
    if ($receiver == "all") {
        # code...
        // echo"all receiving";
        $sql = "select * from users";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // echo"data fetched";
            // $row = $result->fetch_assoc();
            while ($row = $result->fetch_assoc()) {
                // echo $row['email'] . "<br>";
                $stmt = $conn->prepare("insert into message (email, sender, content, date) values(?, ?, ?, ?)");
                if ($stmt) {
                    // echo "sucess here" . "<br>" . $row['email'] . "<br>";
                    $stmt->bind_param("ssss", $row['email'], $sender, $message, $date);
                    $stmt->execute();
                    $_SESSION['sucess'] = "broadcast to" . $receiver ." was sucessfull";
                    header("location:admin.php");
                }
                else{
                    // echo "fail here";
                    $_SESSION['sucess'] = "broadcast to " . $receiver ." was a failure";
                    header("location:admin.php");
                }
            }


        }
    }elseif ($receiver == "students" || $receiver == "finance" || $receiver == "teachers" || $receiver == "prefects"|| $receiver == "management" || $receiver == "staff") {
        # code...
        // echo  $receiver ." receiving";

        $sql = "select * from users where usertype='$receiver'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // echo "stage 2 sucess";
            while ($row = $result->fetch_assoc()) {
                echo "stage 3 sucess";

                $stmt = $conn->prepare("insert into message (email, sender, content, date) values(?, ?, ?, ?)");
                if ($stmt) {
                    // echo "sucess here" . "<br>" . $row['email'] . "<br>";
                    $stmt->bind_param("ssss", $row['email'], $sender, $message, $date);
                    $stmt->execute();
                    $_SESSION['sucess'] = "broadcast to " . $receiver ." was sucessfull";
                    header("location:admin.php");
                }
                else{
                    echo "fail here";
                    $_SESSION['sucess'] = "broadcast to " . $receiver ." was a failure";
                    header("location:admin.php");
                }
                
            }
        }

        
    }
}

?>