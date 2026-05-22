    <?php
    session_start();
    if (!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "admin") {
        header("Location: index.php");
        exit();
       
    }
       require_once "connection.php";

                            $sql = "SELECT * FROM sales ORDER BY sale_date DESC ";

                            $result = $conn->query($sql);
                            
                            $sales_number = $result->num_rows;
                            $total_sales_amount=0;
                            
                            for($i=0; $i<$sales_number; $i++)
                            {
                             $row = $result->fetch_assoc();
                             $row_sales_amount=$row['final_total'];
                             $total_sales_amount= $total_sales_amount+$row_sales_amount; 

                            }

                             $average_sales_amount=0;
                            if($sales_number !=0){
                                 $average_sales_amount = $total_sales_amount / $sales_number;
                                
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
            
            <div class="content_display">
                <div class="content_display_container"><p>No of Sales</p><br>
                <span class="content_display_mainContent"><p><?php echo $sales_number ?></p></span>
            </div>
                <div class="content_display_container"><p>Average per Sales</p><br>
                <span class="content_display_mainContent"><p><?php echo number_format($average_sales_amount,2) ?></p></span>
            </div>
                <div class="content_display_container"><p>Total Revenue</p> <br>
                <span class="content_display_mainContent"><p><?php echo number_format( $total_sales_amount )?></p></span>
            </div>
            </div>

            <div class="main_body">
                <h2 id="main_body_heading">Sales</h2>
                <div class="main_body_table">

                    <table id="mytable" class="display">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Purchased By </th>
                                <th> Tax Amount </th>
                                <th> Total Amount</th>
                                <th> Date </th>
                                <th> View Details </th>
                                <!-- <th> Total Amount </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $sno = 1;
                                 $result->data_seek(0);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>"
                                        // . "<td>" . $row['sale_id'] . "</td>"
                                        . "<td>" . $sno. "</td>"
                                        . "<td>" . $row['customer_name'] . "</td>"
                                        . "<td>" . $row['tax'] . "</td>"
                                        . "<td>" . $row['final_total'] . "</td>"
                                        . "<td>" . $row['sale_date'] . "</td>"
                                        . "<td class='icons'><a class='details_bill'href='view_bill.php?sale_id=" . $row['sale_id'] . "'>Details</a></td>"
                                        . "</tr>";
                                    $sno++;
                                }
                                
                            }
                            else{
                                 echo "<tr><td colspan='6' style='text-align:center;'>No data found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>

    </html>