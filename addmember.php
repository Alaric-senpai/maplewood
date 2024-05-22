
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <title>Management add</title>
    <link rel="stylesheet" href="management.css">
</head>
<body>
    <div class="intro">
        <h1>Maplewood Institute</h1>
        <h2>Add user</h2>
    </div>
    <div class="container-fluid">
        <form action="addmem.php" method="POST">
        <div class="input-box">
                <label for="type">usertype</label>
                <!-- <input type="text" name="type" id="type" required> -->
                <select name="type" id="type" required>
                    <option value="admin">admin</option>
                    <option value="teacher">teacher</option>
                    <option value="finance">Finance</option>
                    <option value="management">Management</option>
                    <option value="staff">Staff</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="student">Student</option>
                    <option value="secretary">secretary</option>
                </select>
            </div>
            <div class="input-box">
                <label for="fname">firstname</label>
                <input type="text" name="fname" id="fname" required>
            </div>
            <div class="input-box">
                <label for="lname">lastname</label>
                <input type="text" name="lname" id="lname"required>
            </div>
            <div class="input-box">
                <label for="post">position</label>
                <input type="text" name="post" id="post" >
            </div>
            <div class="input-box">
                <label for="email">email</label>
                <input type="email" name="email" id="email" >
            </div>
            <div class="input-box">
                <label for="contact">contact</label>
                <input type="text" name="contact" id="contact">
            </div>
            
            
            <div class="input-box links-main">
                <button type="submit" class="btns">Add</button>
                <a href="./admin.php" class="btns">Go back</a>

            </div>
        </form>
    </div>
    
</body>
</html>