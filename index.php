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
  <?php
if(isset($_REQUEST["u_name"]))
    {
    $name=$_REQUEST["u_name"];
    $password=$_REQUEST["u_password"];
    
    $servername="localhost:3306";
    $dusername="root";
    $dpassword="";
    $dname="project";
    
    $conn=new mysqli($servername,$dusername,$dpassword,$dname);
    if($conn->connect_errno !=0)
        {
            die("connection failed".$conn->connect_error);
        }
    $sql="select * from users";
    $result=$conn->query($sql);


    if($result->num_rows > 0)
 {
    while ($row=$result->fetch_assoc()) {
        $temp_name=$row['username'];
        $temp_password=$row['password'];
 }
    if($name==$temp_name && $password==$temp_password){
        header("location:a_dashboard.php");
    }
    else 
        header("location:index.php");
    }

    }
else{
?>
  <div class="sidebar">
        <h2 id="logo">Inventory &<br>Billing system</h2>
</div>
    <div class="container">
        <div class="form">
            <form method="post">
                <h1>Login</h1>
                <label for="uname">User name </label><br>
                <input type="text" id="uname"name="u_name" placeholder="Username" required minlength="5" maxlength="20">
                    <br><br>
                    <div class="password">

                        <label for="password">Password</label>
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