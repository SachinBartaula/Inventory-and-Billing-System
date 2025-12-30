<?php
session_start();
if (!isset($_SESSION["username_session"]) || !isset($_SESSION["password_session"])) {
    header("Location: index.php");
    exit();
}

require_once "connection.php";

if (isset($_GET["edit"])) {
    $id = intval($_GET["edit"]);

    $sql = "SELECT * FROM inventory WHERE inv_id = $id";
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
<script src="validation.js"></script>


</head>
<body>
<div class="sidebar_index">
    <h2 id="logo">Inventory &<br>Billing system</h2>
    <div class="page-contanier"></div>
    <footer>
        <p>Version 1.0</p>
    </footer>
</div>

<div class="Edit_inventory_main">
    <h2>Edit Inventory Item</h2>

    <form method="post" action="a_inventory.php" onsubmit="return inventory_edit_validation(event)">
        <input type="hidden" name="inv_id" value="<?= $row['inv_id']; ?>">

        <table>
            <tr>
                <td><label for="product_name">Product Name:</label></td>
                <td>
                    <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($row['productname']); ?>">
                    <p class="validation_message"></p>
                </td>

                <td><label for="product_price">Price:</label></td>
                <td>
                    <input type="number" id="product_price" name="product_price" value="<?= $row['inv_price']; ?>">
                    <p class="validation_message"></p>
                </td>
            </tr>

            <tr>
                <td><label for="product_quantity">Quantity:</label></td>
                <td>
                    <input type="number" id="product_quantity" name="product_quantity" value="<?= $row['inv_quantity']; ?>">
                    <p class="validation_message"></p>
                </td>

                <td><label for="product_category">Category:</label></td>
                <td>
                    <?php
                    $sql_category = "SELECT cat_id, category_name FROM category";
                    $result_category = $conn->query($sql_category);
                    ?>
                    <select name="product_category" id="product_category">
                        <option value="">-- Select Category --</option>
                        <option value="<?= htmlspecialchars($row['inv_category']); ?>" selected><?= htmlspecialchars($row['inv_category']); ?></option>
                        <?php while ($cat = mysqli_fetch_assoc($result_category)) { ?>
                            <option value="<?= htmlspecialchars($cat['category_name']); ?>"><?= htmlspecialchars($cat['category_name']); ?></option>
                        <?php } ?>
                    </select>
                    <p class="validation_message"></p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="inventory_update" value="Update" class="button_2">
                </td>
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
