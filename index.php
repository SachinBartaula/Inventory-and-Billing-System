<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBS</title>
    <!-- <link rel="stylesheet" href="Styles.css"> -->
     <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <script src="main.js"></script>
</head>

<body>
  
    <div class="sidebar">
        <h2 id="logo">Inventory &<br>Billing system</h2>
</div>
    <div class="container">
        <div class="form">
            <form method="post" action="abc.php">
                <h1>Login</h1>
                <label for="uname">User name </label><br>
                <input type="text" id="uname"name="u_name" placeholder="Username" required minlength="5" maxlength="20">
                    <br><br>
                    <div class="password">

                        <label for="password">Password</label>
                        <br>
                        <input type="password" id="password" name="u_password" placeholder="Password"required minlength="8" maxlength="20" pattern="[0-9]{1-19},[a-z,A-Z]{1-19}">
                        <br><br>
                    </div>
                <div class="button_center">
                    <input class="button" type="submit" name="btn1" value="Login"> &nbsp; &nbsp; &nbsp; &nbsp;
                    <input class="button" type="reset" name="btn2" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</div>  
</body>

</html>