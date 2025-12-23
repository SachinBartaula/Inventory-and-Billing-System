<?php
session_start();

if (!isset($_SESSION["username_session"])) {
    header("Location: index.php");
    exit();
}

// ------------------connection---------------
require_once "connection.php";
// --------------------insert------------------
if (isset($_POST["inventory_submit"])) {

    $ProductName     = $_POST["product_name"];
    $Price           = intval($_POST["product_price"]);
    $Quantity        = intval($_POST["product_quantity"]);
    $Category        = $_POST["product_category"];
    $PurchasedOn     = $_POST["product_purchasedon"];

    $sql = "INSERT INTO inventory (productname, inv_price, inv_quantity, inv_category, purchasedon)
            VALUES ('$ProductName', $Price, $Quantity, '$Category', '$PurchasedOn')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Successful Data Added');</script>";
        header("Location: a_inventory.php");
        exit();
    }
    // -------------------delete-------------------
}
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM inventory WHERE inv_id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: a_inventory.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
// -------------------update-------------------
if (isset($_POST["inventory_update"])) {

    // Get data from form
    $id              = intval($_POST["inv_id"]);  // <-- get the record ID
    $ProductName     = $_POST["product_name"];
    $Price           = intval($_POST["product_price"]);
    $Quantity        = intval($_POST["product_quantity"]);
    $Category        = $_POST["product_category"];
    $PurchasedOn     = $_POST["product_purchasedon"];

    // Update query
    $sql = "UPDATE inventory 
            SET productname = '$ProductName',
                inv_price = $Price,
                inv_quantity = $Quantity,
                inv_category = '$Category'
            WHERE inv_id = $id";

    $result = $conn->query($sql);

    if ($result) {
        echo "<script>alert('Record updated successfully'); window.location='a_inventory.php';</script>";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
// -------------------------------insert category--------------------

if (isset($_POST["category_submit"])) {

    $Category        = $_POST["category_name"];
    $date            = $_POST["salse_date"];

    $sql = "INSERT INTO category (category_name,created_on)
            VALUES ('$Category','$date')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Category added sucessfull'); window.location='a_inventory.php';</script>";

        exit();
    }
}

// ---------------------------display on a_inventory.php-----------------
$sql = "SELECT * FROM inventory ORDER BY purchasedon DESC";
$result = $conn->query($sql);
$inventory_number = $result->num_rows;
$total_inventory_amount = 0;

for ($i = 0; $i < $inventory_number; $i++) {
    $row = $result->fetch_assoc();
    $row_inventory_amount = $row['inv_price'];
    $total_inventory_amount = $total_inventory_amount + $row_inventory_amount;
}

$average_inventory_amount = 0;
if ($inventory_number != 0) {
    $average_inventory_amount = $total_inventory_amount / $inventory_number;
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
        <script src="validation.js"></script>


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
                            <li><b><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></b></li>
                            <li><a href="a_reports.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                            <li><a href="a_billing.php"><i class="fas fa-money-bill"></i> Billing</a></li>
                            <li><a href="a_employee.php"><i class="fa-solid fa-user-plus"></i> Employees</a></li>
                            <li><a href="customer.php"><i class="fa-solid fa-user-plus"></i> Customer</a></li>
                        <?php
                        } else {
                        ?>
                            <li><a href="e_dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                            <li><b><a href="a_inventory.php"><i class="fa-solid fa-warehouse"></i> Inventory</a></b></li>
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
                <h1>Inventory</h1>
                <h4><?php echo $_SESSION["username_session"]; ?></h4>
            </div>
        </div>
        <div class="content_display">
            <div class="content_display_container">
                <p>No of Items</p>
                <span class="content_display_mainContent">
                    <p><?php echo $inventory_number ?></p>
                </span>
            </div>
            <div class="content_display_container">
                <p>Average per Items</p>
                <span class="content_display_mainContent">
                    <p><?php echo number_format($average_inventory_amount,2)?></p>
                </span>
            </div>
            <div class="content_display_container">
                <p>Total Cost</p>
                <span class="content_display_mainContent">
                    <p><?php echo number_format($total_inventory_amount) ?></p>
                </span>
            </div>
        </div>
        <div class="main_body">
            <div class="display_inventory">
                <h2 id="main_body_heading">Inventory</h2>
                <div class="addinventory_button">
                    <input class="button_2" type="submit" name="add_category" value="+ Category" id="btn_category_add" onclick="addcategory()">&nbsp;&nbsp;
                    <input class="button_2" type="submit" name="add_inventory" value="+ Add Inventory" id="inventory_add" onclick="additems()">

                </div>


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
                            $result->data_seek(0);

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
                                        . "<a href='a_inventory.php?delete=" . $row['inv_id'] . "' title='Delete' onclick=\"return confirm('Are you sure?')\">"
                                        . "<i class='fa-solid fa-trash-can'></i>"
                                        . "</a>"
                                        . "</td>"
                                        . "</tr>";
                                    $sno++;
                                }
                            } else {

                                echo "<td colspan=7 style='text-align:center;'>" . "No data found" . "</td>";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ------------------------------form section shown on click event------------------------        -->
        <!-- css applied through input attributes -->
        <div class="addinventory" id="addinventory_id">
            <div class="addinventory_bgcolor">
                <form method="post" onsubmit="return inventory_validation(event)">

                    <span id="close"><a href="a_inventory.php" class="button_link">&times;</a></button></span>
                    <h3>Inventory Items</h3>
                    <table>
                        <tr>
                            <td><label for="product_name">Product Name:</label></td>
                            <td><input type="text" id="product_name" placeholder="Product Name" name="product_name" required></td>

                            <td><label for="product_price">Price:</label></td>
                            <td><input type="text" id="product_price" placeholder="Price" name="product_price" required></td>
                        </tr>



                        <tr>
                            <td><label for="product_quantity">Quantity:</label></td>
                            <td><input type="number" id="product_quantity" placeholder="Quantity" name="product_quantity" value="1" required></td>
                            <td><label for="product_category">Category:</label></td>
                            <td>
                                <?php
                                $sql_category = "SELECT cat_id, category_name FROM  category";
                                $result_category = $conn->query($sql_category);
                                ?>

                                <select name="product_category" required>
                                    <option value="">Select Category</option>

                                    <?php
                                    while ($row = mysqli_fetch_assoc($result_category)) {
                                    ?>
                                        <option value="<?php echo htmlspecialchars($row['category_name']); ?>">
                                            <?php echo htmlspecialchars($row['category_name']); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                            </td>
                        </tr>


                        <tr>

                        </tr>

                        <tr>
                            <td><label for="purchased_date">Purchased on:</label></td>
                            <td><input type="date" id="date" name="product_purchasedon" readonly> </td>
                            <td><input type="submit" name="inventory_submit" value="Add" class="button_2">
                            <td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!-- -----------------------------category model-------------------- -->
        <div class="category_add" id="category_add">
            <div class="addinventory_bgcolor">
              <form method="post" onsubmit="return category_validation()">

                    <span id="close_category">
                        <span id="close"><a href="a_inventory.php" class="button_link">&times;</a></button></span>

                    </span>

                    <h3>Add Category</h3>

                    <table>
                        <tr>
                            <td><label for="Category_name">Category:</label></td>
                            <td><input type="text" id="Category_name" name="category_name" placeholder="Category" required></td>
                        </tr>

                        <tr>
                            <td><label>Created on:</label></td>
                            <td><input type="date" id="catogary_date" name="salse_date" readonly></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="category_submit" value="Add" class="button_2"></td>

                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!-- ------------------------------------------close------------------------------------------------------------ -->

</body>

</html>