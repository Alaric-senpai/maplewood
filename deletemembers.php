
<?php
require 'error.php';
require 'db.php';

if (!isset($_SESSION['email'])) {
    header("location:login.php");
}
if ($_SESSION['usertype'] !== "admin") {
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
    <title>Delete members</title>
    <link rel="stylesheet" href="management.css">
    <style>
        #form{
            display: flex !important;
            background: transparent !important;
            width: 100vw !important;
        }
        #form input{
            width: 300px !important;
            height: 50px !important;

        }
        .search{
            width: 100dvw !important;
            height: max-content !important;
            }
        button{
            float: left !important;
            width: 300px !important;
        }
    </style>
</head>
<body>
    <div class="intro">
        <h1>Maplewood Institute</h1>
        <h2>delete member</h2>
    </div>
    <div class="search">
        <form action="#" method="post" id="form">
        <input type="email" name="email" id="email" placeholder="enter target email">
        <button type="submit" class="btns" name="search">search</button>
        </form>
    </div>
    <h1>
    <?php
            if(isset($_SESSION['fail'])){
                echo $_SESSION['fail'];
                unset($_SESSION['fail']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        ?>
    </h1>
    <div class="container">
    
        <table>
            <thead>
                <tr>
                    <th>firstname</th>
                    <th>lastname</th>
                    <th>email</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
            <?php

            if (isset( $_POST["search"])) {
            $search = $_POST["email"];
            $sql = "select * from users where email='$search'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $email = $row["email"];
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $id = $row["id"];

                ?>
                <tr>
                    <td><?php echo $firstname; ?></td>
                    <td><?php echo $lastname; ?></td>
                    <td><?php echo $email; ?></td> 
                    <td><a href="deletemember.php?id=<?php echo $id; ?>" class = "btns btn-danger">Delete</a></td>
                </tr>
                <?php
                    
            }else{
                $_SESSION['fail'] = "error collecting records";
                header("location:deletemembers.php");
            }
        }
        else{
            ?>
                <tr>
                    <td colspan="4">no records found</td>
                </tr>
            <?php

        }
        // $_SESSION['delete'] = "record deleted sucessfully";
                    // header("location:admin.php");
            ?>
                
                                
            </tbody>
        </table>

        
        
    </div>

    <div class="action">
        <a href="admin.php" class="link">Go back</a>
        <a href="#" class="link">top</a>
    </div>
    <div class="footer">
        <h1>maplewood institute</h1>

    </div>
</body>
</html>