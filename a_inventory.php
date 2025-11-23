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
    <!-- <link rel="stylesheet" href="Styles.css"> -->
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"><!--icon connect garni*/-->
</head>

<body>

    <div class="sidebar">
        <a href="a_dashboard.php"><h2 id="logo" >Inventory &<br>Billing system</h2></a>
        <div class="page-contanier">
            <ul>
                <li><a href="a_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><b><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></b></li>
                <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                <li><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></li>
            </ul>
        </div>
        <footer>
            <a href="logout.php"><b>Logout</b></a>
            <p>Version 1.0</p>
        </footer>
    </div>
    <div class="main">
        <div class="main_box">
            <div class="main_box_heading">
                <h1>Inventory</h1>
                <h4>Admin</h4>
                </div>
            </div>
            <div class="main_body">
                <div class="display_inventory">
                    <h2 id="main_body_heading">Inventory</h2>
                    <div class="addinventory_button">
                        <input class="button" type="submit" name="add_inventory" value="+ Add Inventory" id="inventory_add" onclick="additems()">

                    </div>
                    <div class="main_body_table">
                        <table border="1px">
                            <tr>
                <th> S.N </th>
                <th> Product </th>
                <th> Quantity </th>
                <th> Purchased on </th>
                <th> Total Amount </th>
                <th> Action </th>
            </tr>
            <tr>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
                <td>Dummy data</td>
            </tr>
        </table>
    </div>
            </div>
        </div>
 <!-- ------------------------------form section shown on click event------------------------        -->
 <!-- css applied through input attributes -->
 <div class="addinventory">
     <form>
              <h3>Inventory Items</h3>
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
            
            </tr>
            
            <tr>
                <td><label for="purchased_date">Purchased on:</label></td>
                <td><input type="text" id="purchased_date" placeholder="Purchased Date" name="purchased_date"></td>
            </tr>
        </table>
    </form>
</div>
<!-- ------------------------------------------close------------------------------------------------------------ -->
</body>
<script src="main.js"></script>

</html>