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
    <title>IBS</title>
      <!-- jQuery (MUST be loaded first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"><!--icon connect garni*/-->
    <script src="main.js"></script>
</head>

<body>

    <div class="sidebar">
         <a href="a_dashboard.php"><h2 id="logo" >Inventory &<br>Billing system</h2></a>
        <div class="page-contanier">
            <ul>
                <li><a href="a_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                <li><b><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></b></li>
            </ul>
        </div>
         <footer>
            <a href="logout.php" class="button_2"><b>Logout</b></a>
        <p>Version 1.0</p>
        </footer>
    </div>
    <div class="main">
         <div class="main_box">
            <div class="main_box_heading">
                <h1>Employee</h1><br>
                <h4>Admin</h4>
                </div>
            </div>
        <div class="main_body">
            <h2 id="main_body_heading">Employees</h2>
            <div class="employee_add_button">
                <input class="button_2" type="submit" name="add_inventory" value="+ Add Employees" id="employee_add" onclick="addemployee()">
            </div>
        </div>
        <div class="emp_form_container" id="emp_form_container">
            
            <div class="employee_add"> 
                <form>
                    <div class="employee_add_head">
                        <span id="close" ><button class="button_2" onclick="closeemployee()">&times;</button></span>
                        <h3>Add Employees</h3>
                    </div>
                    <table>
                        <tr>
                            <td><label for="e_username">User Name:</label></td>
                            <td><input type="text" id="e_username" placeholder="User name" name="e_username"></td>
                            
                            <td><label for="e_password">Password:</label></td>
                            <td><input type="text" id="e_password" placeholder="Password" name="e_password"></td>
                        </tr>
                        <tr>
                             <td><label for="emp_created_on">Created on:</label></td>
                            <td><input type="text" id="emp_created_on" readonly> </td>
                         <td><input type="submit" name="employee_submit" value="Submit "class="button_2"><td>

</tr>
                    </table>
                </form>
            </div>
        </div>
        
    </div>
    <?php
    

?>
</body>

</html>