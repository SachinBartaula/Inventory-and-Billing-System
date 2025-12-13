<?php
session_start();
if (!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "admin") {
    header("Location: index.php");
    exit();
}
require_once "connection.php";

// -------------------------------billing submit------------------------------
if (isset($_POST["billing_submit"])) {

    $customer = $_POST["customer_name"];
    $subtotal = $_POST["subtotal_amount"];
    $tax = $_POST["tax_amount"];
    $final_total = $_POST["final_total"];
    $date = $_POST["salse_date"];

    if (!isset($_POST["invoice_data"]) || empty($_POST["invoice_data"])) {
        echo "<script>alert('Sale failed: No items selected'); window.location='a_billing.php';</script>";
        exit();
    }

    $invoice_items = json_decode($_POST["invoice_data"], true);

    if (!$invoice_items || count($invoice_items) === 0) {
        echo "<script>alert('Sale failed: No items selected'); window.location='a_billing.php';</script>";
        exit();
    }

    // ---------- START TRANSACTION ----------
    $conn->begin_transaction();

    try {
        // ---------- INSERT SALE ----------
        $sql = "INSERT INTO sales (customer_name, subtotal, tax, final_total, sale_date)
                VALUES ('$customer', '$subtotal', '$tax', '$final_total', '$date')";
        $conn->query($sql);
        $sale_id = $conn->insert_id;

        // ---------- LOOP ITEMS ----------
        foreach ($invoice_items as $item) {

            $name  = $item["product_name"];
            $qty   = intval($item["quantity"]);
            $price = floatval($item["price"]);
            $total = floatval($item["total"]);

            // ---------- CHECK INVENTORY ----------
            $check_sql = "SELECT inv_quantity 
                          FROM inventory 
                          WHERE productname = '$name'
                          FOR UPDATE";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows === 0) {
                throw new Exception("Product not found:");
            }

            $stock = $check_result->fetch_assoc()["inv_quantity"];

            if ($stock < $qty) {
                throw new Exception("Not enough stock");
            }

            // ---------- INSERT SALES ITEM ----------
            $sql2 = "INSERT INTO sales_items 
                     (sale_id, product_name, quantity, price, total)
                     VALUES 
                     ('$sale_id', '$name', '$qty', '$price', '$total')";
            $conn->query($sql2);

            // ---------- UPDATE INVENTORY ----------
            $update_sql = "UPDATE inventory 
                           SET inv_quantity = inv_quantity - $qty 
                           WHERE productname = '$name'";
            $conn->query($update_sql);
        }

        // ---------- COMMIT ----------
        $conn->commit();

        echo "<script>
                alert('Invoice saved successfully!');
                window.location='view_bill.php?sale_id=$sale_id&print=1';
              </script>";
        exit();

    } catch (Exception $e) {
        // ---------- ROLLBACK ----------
        $conn->rollback();
        echo "<script>
                alert('Sale failed: {$e->getMessage()}');
                window.location='a_billing.php';
              </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IBS</title>
<link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
 <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="sidebar">
    <a href="a_dashboard.php"><h2 id="logo" >Inventory &<br>Billing system</h2></a>
        <div class="page-contanier">
            <ul>
                <li><a href="a_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></li>
                <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                <li><b><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></b></li>
                <li><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></li>
                  <li><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></li>

            </ul>
        </div>
        <footer>
            <a href="logout.php" class="button_2"><b>Logout</b></a>
            <p>Version 1.0</p>
        </footer>
</div>

<div class="main_billing">
    <div class="main_box">
        <div class="main_box_heading">
            <h1>Billing</h1>
            <h4><?php echo $_SESSION["username_session"]; ?></h4>
        </div>
    </div>

    <div class="billing">
        <form method="post" onsubmit="return prepareInvoiceData();">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="salse_date" readonly>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <select id="product_name">
                        <option value="">Select Product</option>
                        <?php
                        $sql = "SELECT productname FROM inventory";
                        $result = $conn->query($sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".htmlspecialchars($row['productname'])."'>".$row['productname']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_price_billing">Price:</label>
                    <input type="text" id="product_price_billing" placeholder="Price">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="product_quantity_billing">Quantity:</label>
                    <input type="number" id="product_quantity_billing" value="1">
                </div>

                <div class="form-group">
                    <label for="customer_name">Customer:</label>
                    <select name="customer_name" id="customer_name">
                        <option value="Cash">Cash</option>
                        <?php
                        $sql_customer = "SELECT customername FROM customer";
                        $res = $conn->query($sql_customer);
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<option value='".htmlspecialchars($row['customername'])."'>".$row['customername']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="discount_billing">Discount % (optional):</label>
                    <input type="text" id="discount_billing" value="0">
                </div>
                <div class="form-group">
                    <label>Apply Tax:</label>
                    <input type="checkbox" id="tax_toggle" onchange="updateTotals()">
                </div>
                <div class="form-group">
                    <label for="total_amount">Total Amount:</label>
                    <input type="text" id="total_amount" readonly>
                </div>
            </div>

            <!-- Hidden inputs -->
            <input type="hidden" name="subtotal_amount" id="subtotal_amount">
            <input type="hidden" name="tax_amount" id="tax_amount">
            <input type="hidden" name="final_total" id="final_total">
            <input type="hidden" name="invoice_data" id="invoice_data">

            <div class="form-group">
                <button type="button" class="billing_btn_add" onclick="add_sales()">Add Item</button><br>
                <button type="submit" name="billing_submit" class="billing-btn">Save Invoice</button>
            </div>
        </form>
    </div>
</div>

    <!-- Invoice display -->
    <div class="invoice-box">
        <h1>Invoice</h1>
        <table class="details">
            <tr>
                <td><strong>Inventory & Billing system</strong></td>
                <td>
                    <strong>Invoice #:</strong> <br>
                    <strong>Date:</strong> <span id="date_text"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Bill To:</strong>
                    <p id="customer_name_invoice"></p>
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
            <tbody id="invoice_items"></tbody>
        </table>
        <table class="totals">
            <tr><td>Subtotal:</td><td id="subtotal">0</td></tr>
            <tr><td>Tax:(13%)</td><td id="tax">0</td></tr>
            <tr><td><strong>Total:</strong></td><td id="final_total_amount"><strong>0</strong></td></tr>
        </table>
        <p><strong>Sales by: </strong> <?php echo $_SESSION["username_session"]; ?> </p>
    </div>
</div>

<script src="main.js">

</script>
</body>
</html>
