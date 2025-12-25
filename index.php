<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="main.js"></script>
</head>

<body>
    <?php
    session_start();
    if (isset($_REQUEST["u_name"])) {

        $name = $_REQUEST["u_name"];
        $password = md5($_REQUEST["u_password"]);
        $role = $_REQUEST["role"];
        require_once "connection.php";
        $sql = "SELECT * FROM user WHERE username='$name' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();

            if ($role == $data['role']) {
                $_SESSION["username_session"] = $data['username'];
                $_SESSION["password_session"] = $data['password'];
                $_SESSION["role_session"] = $data['role'];

                if ($data['role'] == "admin") {
                    $_SESSION['sucessfull'] = "Login Sucessfull";
                    header("Location: a_dashboard.php");
                } else {
                    $_SESSION['sucessfull'] = "Login Sucessfull";
                    header("Location: e_dashboard.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Invalid role selected";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Wrong username or password";
            header("Location: index.php");
            exit();
        }
    }
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
            
            <?php
                     if (isset($_SESSION['error'])) {
                         ?>
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <?= $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php
                                    unset($_SESSION['error']); // remove after showing once
                                }
                                ?>
                            
            <form method="post">
                <h1>Login</h1>
                <label for="uname"><i class="fa-solid fa-user"></i> User name </label><br>
                <input type="text" id="uname" name="u_name" placeholder="Username" required minlength="3" maxlength="20">
                <br><br>
                <div class="password">
                    <label for="password"><i class="fa-solid fa-key"></i> Password</label>
                    <br>
                    <input type="password" id="password" name="u_password" placeholder="Password" required>
                    <br><br>
                    <label>Login As</label><br>
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                    </select>
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