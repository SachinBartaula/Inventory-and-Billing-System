  <?php
require_once "connection.php";

    session_start();
   if(!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "admin") {
    header("Location: index.php");
    exit();
    }
    // -------------------delete inventory-------------------
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); 
    $sql = "DELETE FROM inventory WHERE inv_id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: a_reports.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
    // -------------delete bills------------------
    if (isset($_GET['s_delete'])) {
    $id = intval($_GET['s_delete']); 
    $sql = "DELETE FROM sales WHERE sale_id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: a_reports.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
// -----------------------------edit bills-------------------------
// if(isset($_POST["billing_update"])) {

//     // Get data from form
//     $id              = intval($_POST["s_id"]);  // <-- get the record ID
//   $ProductName     = $_POST["product_name"];
// $Price           = intval($_POST["product_price"]);
// $Quantity        = intval($_POST["product_quantity"]);
// $Category        = $_POST["product_category"];
// $discount        = intval($_POST["discount"]);
// $salesDate         = $_POST["salse_date"];
// $customername       =$_POST["customer_name"];
// // $customerphone     =$_POST["customer_phone"];
     
//     // Update query
//  $sql = "UPDATE sales 
//         SET productname = '$ProductName',
//             s_price = $Price,
//             s_quantity = $Quantity,
//             s_category = '$Category',
//             discount = $discount,
//             salseon = '$salesDate',
//             customername = '$customername'
//             -- customer_id = '$customerphone'
//         WHERE s_id = $id";
//     $result = $conn->query($sql);
//     if ($result) {
//         echo "<script>alert('Record updated successfully'); window.location='a_reports.php';</script>";
//         exit();
//     } else {
//         echo "Error updating record: " . $conn->error;
//     }
// }

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
                <li><a href="a_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                <li><b><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></b></li>
                <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                <li><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></li>
                  <li><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></li>

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
                <h1>Reports</h1>
                <h4><?php echo $_SESSION["username_session"]; ?></h4>
                </div>
            </div>
        <div class="main_body">
    <h2 id="main_body_heading">Top Sales item</h2>
    <div class="main_body_table">
       <table id="salesTable" class="display">
    <thead>
        <tr>
                                <th> ID </th>
                                <th> Purchased By </th>
                                <th> Tax Amount </th>
                                <th> Total Amount</th>
                                <th> Date </th>
                                <th> View Details </th>

                 </tr>
                </thead>
                <tbody>
                   <?php

$sql = "SELECT * FROM sales";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"
           . "<td>" . $row['sale_id'] . "</td>"
                                        . "<td>" . $row['customer_name'] . "</td>"
                                        . "<td>" . $row['tax'] . "</td>"
                                        . "<td>" . $row['final_total'] . "</td>"
                                        . "<td>" . $row['sale_date'] . "</td>"
                                        . "<td><a class='details_bill'href='view_bill.php?sale_id=" . $row['sale_id'] . "'>Details</a> "
                                        . "<a class='icons href='a_reports.php?s_delete=" . $row['sale_id'] . "' title='Delete' onclick=\"return confirm('Are you sure?')\">"
                                            . "<i class='fa-solid fa-trash-can'></i>"
                                        . "</a>"
                // . "<a href='edit_bills.php?edit=" . $row['sale_id'] . "' title='Edit'>"
                //     . "<i class='fa-solid fa-pencil'></i>"
                // . "</a> &nbsp;"
            . "</td>"
            . "</tr>";
        $sno++;
    }
}
?>      
    </tbody>
</table>
    </div>
    <h2 id="main_body_heading">Inventory item</h2>
     <div class="main_body_table">

                      <table id="inventoryTable" class="display">
    <thead>
        <tr>
                        <th> S.N </th>
                        <th> Product </th>
                        <th> Quantity </th>
                        <th> Category</th>
                        <th> Purchased Price</th>
                        <th> Date</th>
                        <th> Action</th>
                 </tr>
                </thead>
                <tbody>
                   <?php
$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"
            . "<td>" . $sno . "</td>"
            . "<td>" . $row['productname'] . "</td>"
            . "<td>" . $row['inv_quantity'] . "</td>"
            . "<td>" . $row['inv_category'] . "</td>"
            . "<td>" . $row['inv_price'] . "</td>"
            . "<td>" . $row['purchasedon'] . "</td>"
            . "<td class='icons'>"
                . "<a href='edit_inventory.php?edit=" . $row['inv_id'] . "' title='Edit'>"
                    . "<i class='fa-solid fa-pencil'></i>"
                . "</a> &nbsp;"
                . "<a href='a_reports.php?delete=" . $row['inv_id'] . "' title='Delete' onclick=\"return confirm('Are you sure?')\">"
                    . "<i class='fa-solid fa-trash-can'></i>"
                . "</a>"
            . "</td>"
            . "</tr>";
        $sno++;
    }
}
?>

    </tbody>
</table>
    </div>
</div>

</body>
</html>