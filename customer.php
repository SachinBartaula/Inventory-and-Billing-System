 <?php
    session_start();

    if (!isset($_SESSION["username_session"])) {
        header("Location: index.php");
        exit();
    }
    require_once "connection.php";
    if (isset($_POST["customer_submit"])) {

        $customer        = $_POST["c_name"];
        $phone           = $_POST["c_phone"];
        $address         = $_POST["c_address"];

        $sql_customer = "INSERT INTO customer (customername,customerphone,customeraddress) VALUES ('$customer','$phone','$address')";
        $result_customer = $conn->query($sql_customer);
        if ($result_customer) {
            echo "<script>
                window.location = 'customer.php';
                </script>";
        }
    }
    // ----------------------delete-------------------- 
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $sql = "DELETE FROM customer WHERE c_id = $id";
        $result = $conn->query($sql);
        if ($result) {
            header("Location: customer.php");
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
     <title>Document</title>
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
         <?php if ($_SESSION["role_session"] == "admin") {
            ?>
             <a href="a_dashboard.php">
             <?php
            } else {
                ?>
                 <a href="e_dashboard.php">
                 <?php
                }
                    ?>
                 <h2 id="logo">Inventory &<br>Billing system</h2>
                 </a>
                 <div class="page-contanier">
                     <ul>
                         <?php if ($_SESSION["role_session"] == "admin") {
                            ?>
                             <li><a href="a_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                             <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                             <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                             <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                             <li><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></li>
                             <li><b><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></b></li>
                         <?php
                            } else {
                            ?>
                             <li><a href="e_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                             <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                             <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                             <li><b><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></b></li>


                         <?php
                            }
                            ?>

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
                 <h1>Customer</h1>
                 <h4><?php echo
                        $_SESSION["username_session"]; ?></h4>
             </div>
         </div>
         <div class="main_body">
             <div class="customer_add_button">
                 <input class="button_2" type="submit" name="add_customer" value="+ Add Customer" id="customer_add" onclick="addCustomer()">
             </div>

             <div class="main_body_table">
                 <!-- <table class="customerTable" id="customerTable"> -->
                 <table class="customerTable" id="mytable">
                     <thead>
                         <tr>
                             <th>S.N</th>
                             <th>Customer</th>
                             <th>Address</th>
                             <th>Phone</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $sql = "SELECT * FROM customer";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $sno = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>"
                                        . "<td>" . $sno . "</td>"
                                        . "<td>" . $row['customername'] . "</td>"
                                        . "<td>" . $row['customeraddress'] . "</td>"
                                        . "<td>" . $row['customerphone'] . "</td>"
                                        . "<td class='icons'>"
                                        . "<a class='details_bill' href='view_customer.php?customername=" . $row['customername'] . "' title='View Details'>
                                          Details"
                                        . "</a> "
                                        . "<a href='customer.php?delete=" . $row['c_id'] . "' title='Delete' onclick=\"return confirm('Are you sure?')\">"
                                        . "<i class='fa-solid fa-trash-can'></i>"
                                        . "</a>"
                                        . "</td>"
                                        . "</tr>";
                                    $sno++;
                                }
                            } else {
                                echo "<tr>
        <td colspan='3' style='text-align:center;'>No data found</td>
      </tr>";
                            }
                            ?>
                     </tbody>
                     <tbody>
                     </tbody>
                 </table>
             </div>

             <!-- CUSTOMER FORM POPUP -->
             <div class="customer_form_container" id="customer_form_container">

                 <div class="customer_add">
                     <form method="post" onsubmit="return customer_validation(event)">
                         <div class="customer_add_head">

                             <span id="close">
                                 <a href="customer.php" class="button_link">&times;</a>
                             </span>

                             <h3>Add Customer</h3>
                         </div>

                         <table>
                             <tr>
                                 <td><label for="c_name">Customer Name:</label></td>
                                 <td><input type="text" id="c_name" placeholder="Customer name" name="c_name" required></td>

                                 <td><label for="c_phone">Phone:</label></td>
                                 <td><input type="text" id="c_phone" placeholder="Phone number" name="c_phone" required></td>
                             </tr>

                             <tr>
                                 <td><label for="c_address">Address:</label></td>
                                 <td><input type="text" id="c_address" placeholder="Address" name="c_address" required></td>

                                 <td><label for="customer_created_on">Created on:</label></td>
                                 <td><input type="text" id="date" name="customer_createdOn" readonly></td>
                             </tr>

                             <tr>
                                 <td><input type="hidden" name="" value=""></td>
                                 <td><input type="submit" name="customer_submit" value="Submit" class="button_2"></td>
                             </tr>

                         </table>
                     </form>
                 </div>

             </div>

         </div>
         <script src="validation.js"></script>
 </body>

 </html>