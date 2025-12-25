<?php
session_start();

if (!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "employee") {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <script src="main.js"></script>


</head>

<body>
    <div class="sidebar">
            <a href="e_dashboard.php">
                <h2 id="logo">Inventory &<br>Billing system</h2>
            </a>
            <div class="page-contanier">
                <ul>
                    <li><b><a href="e_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></b></li>
                    <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                    <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                    <li><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></li>


                </ul>
            </div>
            <footer>
                <a href="logout.php" class="button_2"><b>Logout</b></a>
                <p>Version 1.0</p>
            </footer>
        </div>

        <div class="main">
            <div class="main_box_dashboard">
                <div class="main_box_heading_dashboard">
                    <h1>Dashboard</h1>
                    <h4><?php echo $_SESSION["username_session"]; ?></h4>
                </div>
                <div class="clock">
                    <span id="hrs"></span>
                    <span id="min"></span>
                    <span id="sec"></span>
                    <span id="ampm"></span>
                </div>
            </div>
            
</body>

</html>