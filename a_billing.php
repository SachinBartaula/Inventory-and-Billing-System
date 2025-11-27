  <?php
    session_start();
   if(!isset($_SESSION["username_session"]) || !isset($_SESSION["password_session"])) {
    header("Location: index.php");
    exit();
    }?>
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
                <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                <li><b><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></b></li>
                <li><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></li>
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
                <h1>Billing</h1><br>
                <h4>Admin</h4>
                </div>
            </div>
        <div class="main_body">

        <div class="billing">
        <form>
            <h3>Billing</h3>
            <table>
                <tr>
                    <td><label for="product_name">Product Name:</label></td>
                    <td><input type="text" id="product_name" placeholder="Product Name" name="product_name"></td>
                    
                    <td><label for="product_price">Price:</label></td>
                    <td><input type="text" id="product_price" placeholder="Price" name="product_price"></td>
                </tr>
                
                
                
                <tr>
                    <td><label for="product_quantity">Quantity:</label></td>
                    <td><input type="text" id="product_quantity" placeholder="Quantity" name="product_quantity"></td>
                    <td><label for="product_category">Category:</label></td>
                    <td><input type="text" id="product_category" placeholder="Category" name="product_category"></td>
                </tr>

        <tr>
                <td><label for="discount">Discount %:</label></td>
                <td><input type="text" id="discount" placeholder="Discount" name="discount"></td>
                <td><label for="Salse_on">Salse on:</label></td>
                <td><input type="text" id="Salse_on" name="salse_date"readonly></td>
                    
            </tr>
            
        <tr>
                <td><label for="customer_name">Customer:</label></td>
                <td><input type="text" id="customer_name" placeholder="Customer Name" name="customer_name"></td>
                <td><label for="customer_phone">Phone no:</label></td>
                <td><input type="text" id="customer_phone" name="customer_phone"placeholder="Customer phone number" ></td>
                    
            </tr>
            
            <tr>
                <td><label for="total_amount">Total Amount:</label></td>
                <td><input type="text" id="total_amount" readonly name="discount"></td>
                <td><input type="submit" name="inventory_submit" value="Submit "class="button_2"></td>
            </tr>
        </table>
    </form>
</div>
</div>
    </div>
    </div>
</body>

</html>