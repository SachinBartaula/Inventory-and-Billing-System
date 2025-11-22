<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBS</title>
    <!-- <link rel="stylesheet" href="Styles.css"> -->
     <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"><!--icon connect garni*/-->
    <script src="main.js"></script>
  
</head>

<body>
  <?php
    session_start();
if(isset($_REQUEST["u_name"]))
    {
    $name=$_REQUEST["u_name"];
    $password=$_REQUEST["u_password"];
    
   require_once "connection.php";
    $sql="select * from users";
    $result=$conn->query($sql);


    if($result->num_rows > 0)
 {
    while ($data=$result->fetch_assoc()) {
        $temp_name=$data['username'];
        $temp_password=$data['password'];
 }
    if($name==$temp_name && $password==$temp_password){
        $_SESSION["username_session"]=$temp_name;
        $_SESSION["password_session"]=$temp_password;
        header("location:a_dashboard.php");
    }
    else 
        header("location:index.php");
    }

    }
else{
?>
  <div class="sidebar_index">
        <h2 id="logo">Inventory &<br>Billing system</h2>
         <div class="page-contanier">
        </div>
        <footer>
        <p>Version 1.0</p>
        </footer>

</div>
    <div class="container">
        <div class="form">
            <form method="post">
                <h1>Login</h1>
                <label for="uname"><i class="fa-solid fa-user"></i> User name </label><br>
                <input type="text" id="uname"name="u_name" placeholder="Username" required minlength="5" maxlength="20">
                    <br><br>
                    <div class="password">

                        <label for="password"><i class="fa-solid fa-key"></i> Password</label>
                        <br>
                        <input type="password" id="password" name="u_password" placeholder="Password"required>
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

<?php
}
  ?>
</body>

</html>