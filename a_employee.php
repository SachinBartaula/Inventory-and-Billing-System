  <?php
    session_start();
   if(!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "admin") {
    header("Location: index.php");
    exit();
    }
    require_once "connection.php";
    // ------------------------create employee------------------
if(isset($_POST["employee_submit"])){
    
    $username =$_POST["e_username"];
    $password =$_POST["e_password"];
    $role=$_POST["role"];    
    $date=$_POST["employee_createdOn"];
    $sql="INSERT INTO user (username,password,role) values ('$username','$password','$role')";

    $result=$conn->query($sql);
    if($result){
        echo "<script>alert('New employee id created'); window.location='a_employee.php';</script>";

    }
}
// ---------------------------------delete-----------------------------
 if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); 
    $sql = "DELETE FROM user WHERE user_id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: a_employee.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
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
    <script src="main.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"><!--icon connect garni*/-->
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
                <h1>Employee</h1>
                <h4>Admin</h4>
                </div>
            </div>
        <div class="main_body">
            <h2 id="main_body_heading">Employees</h2>
            <div class="employee_add_button">
               
                <input class="button_2" type="submit" name="add_inventory" value="+ Add Employees" id="employee_add" onclick="addemployee()">
            </div>
            
            <div class="main_body_table">
                <table class="display">
                  <thead>
          <tr>
                        <th> S.N </th>
                        <th> Employee </th>
                        <th> Action </th>
                 </tr>
                </thead>
                <tbody>
                    <?php
$sql = "SELECT * FROM user where role='employee'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"
            . "<td>" . $sno . "</td>"
            . "<td>" . $row['username'] . "</td>"
            . "<td class='icons'>"
             . "<a href='a_employee.php?delete=" . $row['user_id'] . "' title='Delete' onclick=\"return confirm('Are you sure?')\">"
                    . "<i class='fa-solid fa-trash-can'></i>"
                . "</a>"
                 . "</td>"
            // . "<td>" . $row['customername'] . "</td>"
            . "</tr>";
            $sno++;
        }
    }
    else{
        echo "<tr>
        <td colspan='3' style='text-align:center;'>No data found</td>
      </tr>";
    }
    ?>      
    </tbody>
</table>
</div>
</div>
        <div class="emp_form_container" id="emp_form_container">
            
            <div class="employee_add"> 
                <form method="post">
                    <div class="employee_add_head">
                        <span id="close" ><button class="button_2" onclick="closeemployee()">&times;</button></span>
                        <h3>Add Employees</h3>
                    </div>
                    <table>
                        <tr>
                            <td><label for="e_username">User Name:</label></td>
                            <td><input type="text" id="e_username" placeholder="User name" name="e_username"></td>
                            
                            <td><label for="e_password">Password:</label></td>
                            <td><input type="password" id="e_password" placeholder="Password" name="e_password"></td>
                        </tr>
                        <tr>
                             <td><label for="role">Role:</label></td>
                            <td><input type="text" id="role" name="role" value="employee" readonly> </td>
                             <td><label for="emp_created_on">Created on:</label></td>
                            <td><input type="text" id="Salse_on" name="employee_createdOn" readonly> </td>
                        </tr>
                        <tr>
                         <td><input type="hidden" name="" value=" "class=""><td>
                         <td><input type="submit" name="employee_submit" value="Submit "class="button_2"><td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <!-- ----------------------------------customer------------------------------  -->

    <?php
    

?>

</body>

</html>