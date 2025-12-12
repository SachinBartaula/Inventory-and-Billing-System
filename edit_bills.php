<?php
session_start();
if(!isset($_SESSION["username_session"]) || !isset($_SESSION["password_session"])) {
    header("Location: index.php");
    exit();
}

require_once "connection.php";

if (isset($_GET["edit"])) {
    $id = intval($_GET["edit"]);

    $sql = "SELECT * FROM sales WHERE sale_id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
    <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
     <div class="sidebar_index">
        <h2 id="logo" >Inventory &<br>Billing system</h2>
         <div class="page-contanier">
        </div>
        <footer>
        <p>Version 1.0</p>
        </footer>

</div>
    <div class="edit_bills">
        <form method="post"action="a_reports.php">
            <h3>Billing</h3>
            <input type="hidden" name="s_id" value="<?php echo $row['s_id']; ?>">

            <table>
                <tr>
                    <td><label for="product_name">Product Name:</label></td>
                    <td><input type="text" id="product_name" placeholder="Product Name" name="product_name" value="<?php echo htmlspecialchars($row['productname']); ?>"required></td>
                    
                    <td><label for="product_price">Price:</label></td>
                    <td><input type="text" id="product_price" placeholder="Price" name="product_price"value="<?php echo ($row['s_price']); ?>"required></td> </td>
                </tr>
                
                
                
                <tr>
                    <td><label for="product_quantity">Quantity:</label></td>
                    <td><input type="text" id="product_quantity" placeholder="Quantity" name="product_quantity"value="<?php echo ($row['s_quantity']); ?>"required></td></td>
                    <td><label for="product_category">Category:</label></td>
                    <td><input type="text" id="product_category" placeholder="Category" name="product_category"value="<?php echo htmlspecialchars($row['s_category']); ?>"required ></td></td>
                </tr>

        <tr>
                <td><label for="discount">Discount %:</label></td>
                <td><input type="text" id="discount" placeholder="Discount" name="discount"value="<?php echo ($row['discount']); ?>"required></td></td>
                <td><label for="Salse_on">Salse on:</label></td>
                <td><input type="text" id="Salse_on" name="salse_date" readonly value="<?php echo ($row['salseon']); ?>"required></td></td>
                    
            </tr>
             <tr>
                <td><label for="customer_name">Customer:</label></td>
                <td><input type="text" id="customer_name" placeholder="Customer Name" name="customer_name"value="<?php echo ($row['customername']); ?>" ></td>
                <td><label for="customer_phone">Phone no:</label></td>
                <td><input type="text" id="customer_phone" name="customer_phone"placeholder="Customer phone number"value="<?php echo ($row['customer_id']); ?>" ></td>
                    
            </tr>
            
            <tr>
                <td><label for="total_amount">Total Amount:</label></td>
                <td><input type="text" id="total_amount" readonly name="total_amount"></td>
                <td><input type="submit" name="billing_update" value="Submit "class="button_2"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php
    } else {
        echo "Error: Record not found.";
    }

    $conn->close();
} else {
    echo "No record selected to edit.";
}
?>
