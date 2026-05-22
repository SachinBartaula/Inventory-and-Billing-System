<?php
session_start();

if (!isset($_SESSION["username_session"])) {
    header("Location: index.php");
    exit();
}
require_once "connection.php";
 // -------------------- if payment done
if (isset($_GET['update'])) {
    $id = intval($_GET['update']); 
    $sql = "UPDATE sales SET status = 'Cash' WHERE sale_id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: customer.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


if (!isset($_GET['customername'])) {
    die("Customer not found");
}

$customer_name = mysqli_real_escape_string($conn, $_GET['customername']);

// Fetch all sales of this customer
$sales_sql = "SELECT * FROM sales 
              WHERE customer_name = '$customer_name'  AND (status IS NULL OR status = '')
              ORDER BY sale_date DESC";

$sales_result = $conn->query($sales_sql);

if (!$sales_result) {
    die("Query Failed: " . $conn->error);
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
    <!-- <link rel="stylesheet" href="Styles.css"> -->
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <!--icon connect garni*/-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="main.js"></script>

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
                            <li><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></li>
                        <?php
                        } else {
                        ?>
                            <li><a href="e_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                            <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                            <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                            <li><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></li>


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
                <h1>Customer Sales Record</h1>
                <h4><?php echo
                    $_SESSION["username_session"]; ?></h4>
            </div>
        </div>
        <div class="main_body">

            <h2 style="text-align: center;">Sales Records of <?= htmlspecialchars($customer_name); ?></h2>
            <button class="print_button" onclick="print_function()">
                <i class="fas fa-print"></i> Print
            </button>
            <div class="main_body_table">
                <table class="display" id="customerSalesTable">
                    <thead>

                        <tr>
                            <th>S.N</th>
                            <th>Sub total</th>
                            <th>Tax</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($sales_result->num_rows > 0) {
                            $sn = 1;
                            while ($row = $sales_result->fetch_assoc()) {
                                echo "<tr>" .
                                    "<td>" . $sn . "</td>" .
                                    "<td>" . $row['subtotal'] . "</td>" .
                                    "<td>" . $row['tax'] . "</td>" .
                                    "<td>" . $row['final_total'] . "</td>" .
                                    "<td>" . $row['sale_date'] . "</td>" .
                                    "<td class='icons'>"
                                        . "<a class='details_bill' href='view_customer.php?update=" . $row['sale_id'] . "' title='Delete' onclick=\"return confirm('Is bill paid ?')\">"
                                        . "Paid"
                                        . "</a>"
                                        . "</td>"
                                        . "</tr>";
                                $sn++;
                            }
                        } else {
                            echo "<tr>
                              <td colspan='6' style='text-align:center;'>No data found</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>




</body>

</html>