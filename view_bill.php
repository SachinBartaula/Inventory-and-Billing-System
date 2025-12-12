 <?php
    require_once "connection.php";
    session_start();
    if (!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "admin") {
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
             <div class="main_body">
                 <h2 id="main_body_heading">Top Sales item</h2>
                 <div class="main_body_table">
                     <table id="salesTable" class="display">
                         <thead>
                             <tr>
                                 <th> S.N </th>
                                 <th> Product Name</th>
                                 <th> Quantity </th>
                                 <th> Price </th>
                                 <th> Total Amount </th>

                             </tr>
                         </thead>
                         <tbody>
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
                                    while ($row = $result->fetch_assoc()) {
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
                                $sql_total_amount = "SELECT final_total,tax FROM sales WHERE sale_id = $sale_id";
                                $result_amount = $conn->query($sql_total_amount);

                                $total_amount = "";
                                if ($result_amount && $result_amount->num_rows > 0) {
                                    $row_amount = $result_amount->fetch_assoc();
                                    $total_amount = $row_amount['final_total'];
                                    $tax=$row_amount['tax'];
                                }
                                ?>
                         </tbody>
                        </table>
                    </div>
         <div class="amt_view">
    <div class="amt_row">
        <span>+ Tax:</span>
        <span><?php echo $tax; ?></span>
    </div>
    <div class="amt_row total">
        <span>= Amount:</span>
        <span><?php echo $total_amount; ?></span>
    </div>
</div>
                </div>
         </div>



     </body>

 </html>
 </body>

 </html>