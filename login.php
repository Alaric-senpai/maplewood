

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maplewood institute</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="form" id="login">
        <a href="./index.php" class="logo">Maplewood</a>
        <h1>LOGIN</h1>
        <form action="loginverify.php" method="post">
            <div class="input-box">
                <label for="email">Email</label> <br>
                <input type="email" name="email" id="email" placeholder="email@gmail.com" value="" aria-autocomplete="off">
            </div>
            <div class="input-box">
                <label for="password">password</label> <br>
                <div class="holder">
                    <input type="password" name="password" id="password" placeholder="password" value="" aria-autocomplete="off">
                    <span id="state">show</span> <br>
                </div>
                <a href="#">forgot password?</a>
            </div>
            <div class="input-box">
                <button type="submit" name="login">LOGIN</button>
            </div>
            <div class=" fail">
                    <?php
                    session_start();
                    if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            
                    }
                    
                    ?>
            </div>
        </form>
    </div>
    <script src="./script5.js"></script>
</body>
</html>