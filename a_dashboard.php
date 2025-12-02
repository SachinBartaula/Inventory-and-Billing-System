    <?php
    session_start();
   if(!isset($_SESSION["username_session"]) || !isset($_SESSION["password_session"])) {
    header("Location: index.php");
    exit();
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   <!-- jQuery (MUST be loaded first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>

<!-- Your main.js -->
<script src="main.js"></script>

<!--icon connect garni*/-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- main css -->
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">

<!-- google font -->
 <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">

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
            <a href="logout.php" class="button_2"><b>Logout</b></a>
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
            <h2 id="main_body_heading">Sales</h2>
            <div class="main_body_table">
                <table id="myTable" class="display">
    <thead>
        <tr>
                        <th> S.N </th>
                        <th> Product </th>
                        <th> Quantity </th>
                        <th> Purchased By </th>
                        <th> Total Amount </th>
                        <th> Action </th>
                 </tr>
                </thead>
                <tbody>
                   <tr>
                     <td>Row 1 Data 1</td>
                      <td>Row 1 Data 2</td>
                     <td>Row 2 Data 1</td>
                  <td>Row 2 Data 2</td>
                   <td>Row 2 Data 1</td>
                  <td>Row 2 Data 2</td>
                 </tr>
                 <tr>
                  <td>Row 2 Data 1</td>
                  <td>Row 2 Data 2</td>
                  <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
                 <td>Row 2 Data 1</td>
                  <td>Row 2 Data 2</td>
                 
             </tr>
    </tbody>
</table>
    </div>
</div>
</body>

</html>