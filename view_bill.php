 <?php
    require_once "connection.php";
    session_start();
    if (!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "admin") {
        header("Location: index.php");
        exit();
    }

    if (!isset($_GET['sale_id'])) {
        die("Invalid invoice");
    }

    $sale_id = intval($_GET['sale_id']);

     $sql = "SELECT * FROM sales_items where sale_id=$sale_id";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                }
     $sql_show_data = "SELECT customer_name,sale_date FROM sales where sale_id=$sale_id";
                                $result_show_data = $conn->query($sql_show_data);
                                if ($result_show_data->num_rows > 0) {
                                    $row_show_data = $result_show_data->fetch_assoc();
                                }

    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>

 <body>
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
             <a href="a_dashboard.php">
                 <h2 id="logo">Inventory &<br>Billing system</h2>
             </a>
             <div class="page-contanier">
                 <ul>
                     <li><b><a href="a_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></b></li>
                     <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                     <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
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
                     <h1>Bills</h1>
                     <h4><?php echo $_SESSION["username_session"]; ?></h4>
                 </div>
             </div>
          
                     <div class="invoice-box-print">
                         <h1>Invoice</h1>
                    <button class="print_button" onclick="print_function()">
    <i class="fas fa-print"></i> Print
</button>
                         <table class="details">
                             <tr>
                                 <td><strong>Inventory & Billing system</strong></td>
                                 <td>
                                     <strong>Invoice #:<?php echo  $row['sale_id'] ?></strong> <br>
                                     <strong>Date:<?php echo  $row_show_data['sale_date'] ?></strong> <span></span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="2">
                                     <strong>Bill To:</strong>
                                     <p><?php echo  $row_show_data['customer_name'] ?></p>
                                 </td>
                             </tr>
                         </table>
                         <table class="items">
                             <tr>
                                 <th>No.</th>
                                 <th>Item</th>
                                 <th>Quantity</th>
                                 <th>Unit Price</th>
                                 <th>Total</th>
                             </tr>
                             <?php

                                if (isset($_GET['sale_id'])) {
                                    $sale_id = intval($_GET['sale_id']);
                                } else {
                                    die("No sale ID provided.");
                                }

                                $sql = "SELECT * FROM sales_items where sale_id=$sale_id";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $sno = 1;
                                    while
                                        ($row = $result->fetch_assoc()){
                                        echo "<tr>"
                                            . "<td>" . $sno . "</td>"
                                            . "<td>" . $row['product_name'] . "</td>"
                                            . "<td>" . $row['quantity'] . "</td>"
                                            . "<td>" . $row['price'] . "</td>"
                                            . "<td>" . $row['total'] . "</td>"
                                            . "</tr>";
                                        $sno++;
                                    }
                                }
                            
                                $sql_total_amount = "SELECT final_total,tax,subtotal FROM sales WHERE sale_id = $sale_id";
                                $result_amount = $conn->query($sql_total_amount);

                                $total_amount = "";
                                if ($result_amount && $result_amount->num_rows > 0) {
                                    $row_amount = $result_amount->fetch_assoc();
                                    $total_amount = $row_amount['final_total'];
                                    $tax = $row_amount['tax'];
                                    $subtotal = $row_amount['subtotal'];
                                }
                                ?>
                         </table>
                         <table class="totals">
            <tr><td>Subtotal:</td><td><?php echo $subtotal; ?></td></tr>
            <tr><td>Tax:(13%)</td><td><?php echo $tax; ?></td></tr>
            <tr><td><strong>Total:</strong></td><td ><strong><?php echo $total_amount; ?></strong></td></tr>
        </table>
        <p><strong>Sales by: </strong> <?php echo $_SESSION["username_session"]; ?> </p>
                     </div>
                 </div>



                 <?php if (isset($_GET['print'])) { ?>
                     <script>
                         window.onload = function() {
                             window.print();
                         };
                     </script>
                 <?php } ?>

     </body>

 </html>