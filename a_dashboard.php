<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="Styles.css"> -->
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"><!--icon connect garni*/-->
    <script src="main.js"></script>
</head>
<body>
    <div class="sidebar">
         <a href="a_dashboard.php"><h2 id="logo" >Inventory &<br>Billing system</h2></a>
        <div class="page-contanier">
            <ul>
                <li><b><a href="a_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></b></li>
                <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                <li><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></li>
            </ul>
        </div>
        <footer>
        <p>Version 1.0</p>
        </footer>
    </div>
    
    <div class="main">
        <div class="main_box_dashboard">
            <div class="main_box_heading_dashboard">
                <h1>Dashboard</h1>
                <h4>Admin</h4>
                </div>
                <div class="clock">
                <span id="hrs"></span>
                <span id="min"></span>
                <span id="sec"></span>
                <span id="ampm"></span>
            </div>
        </div>
        <div class="main_body">
            <h2 id="main_body_heading">Salse</h2>
            <div class="main_body_table">
            <table border="1px">
            <tr>
                <th> S.N </th>
                <th> Product </th>
                <th> Quantity </th>
                <th> Purchased By </th>
                <th> Total Amount </th>
                <th> Action </th>
            </tr>
            <tr>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
            </tr>
</table>
</div>
<h2 id="main_body_heading">Top Salse item</h2>
<div class="main_body_table">
             <table border="1px">
                <tr>
                <th> S.N </th>
                <th> Product </th>
                <th> Quantity </th>
                <th> Stock </th>
                <th> Action </th>
            </tr>
             <tr>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
            </tr>
          
            </table>
</div>
</div>
</body>

</html>