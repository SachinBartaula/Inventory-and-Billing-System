  <?php
    session_start();
    if (!isset($_SESSION["username_session"]) || !isset($_SESSION["password_session"])) {
        header("Location: index.php");
        exit();
    }
    require_once "connection.php";

    // -------------------------billing insert into sales table and customer table-----------------------
    if (isset($_POST["billing_submit"])) {

        $ProductName     = $_POST["product_name"];
        $Price           = intval($_POST["product_price"]);
        $Quantity        = intval($_POST["product_quantity"]);
        $Category        = $_POST["product_category"];
        $discount        = intval($_POST["discount"]);
        $salesDate         = $_POST["salse_date"];
        $customer        = $_POST["customer_name"];
        $phone           = $_POST["customer_phone"];
        $totalamount      = intval($_POST["total_amount"]);

        $sql = "INSERT INTO sales (productname, s_price, s_quantity, s_category,discount, salseon,customername,totalamount)
            VALUES ('$ProductName', $Price, $Quantity, '$Category',$discount, '$salesDate','$customer',$totalamount)";
        $result = $conn->query($sql);
        // $sql_customer="INSERT INTO customer (customername,customerphone) VALUES ('$customer','$phone')";
        //     $result_customer=$conn->query($sql_customer);
        // if ($result && $result_customer) 
        if ($result) {
            echo "<script>
    window.location = 'a_billing.php';
    </script>";
            exit();
        }
    }

    // ---------------------------------------edit---------------------------
    if (isset($_POST["billing_update"])) {

        // Get data from form
        $id              = intval($_POST["s_id"]);  // <-- get the record ID
        $ProductName     = $_POST["product_name"];
        $Price           = intval($_POST["product_price"]);
        $Quantity        = intval($_POST["product_quantity"]);
        $Category        = $_POST["product_category"];
        $discount        = intval($_POST["discount"]);
        $salesDate         = $_POST["salse_date"];
        $customername       = $_POST["customer_name"];



        // Update query
        $sql = "UPDATE sales 
            SET productname = '$ProductName',
                s_price = $Price,
                s_quantity = $Quantity,
                s_category = '$Category',
                discount = $discount,
                salseon = '$salesDate',
                customername='$customername'
            WHERE s_id = $id";

        $result = $conn->query($sql);

        if ($result) {
            echo "<script>alert('Record updated successfully'); window.location='a_inventory.php';</script>";
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"><!--icon connect garni*/-->
 
    </head>

  <body>

      <div class="sidebar">
          <a href="a_dashboard.php">
              <h2 id="logo">Inventory &<br>Billing system</h2>
          </a>
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
                  <h1>Billing</h1>
                  <h4>Admin</h4>
              </div>
          </div>
          <div class="main_body">

              <div class="billing">
                  <form method="post">
                      <h3>Billing</h3>
                      <table>


                              <input type="date" id="date" name="salse_date" readonly>
                          <tr>
                              <td><label for="product_name">Product Name:</label></td>
                              <td><input type="text" id="product_name" placeholder="Product Name" name="product_name" required></td>

                              <td><label for="product_price_billing">Price:</label></td>
                              <td><input type="text" id="product_price_billing" placeholder="Price" name="product_price" required></td>
                          </tr>



                          <tr>
                              <td><label for="product_quantity_billing">Quantity:</label></td>
                              <td><input type="number" id="product_quantity_billing" placeholder="Quantity" name="product_quantity" value="1" required></td>
                              <td><label for="customer_name">Customer:</label></td>
                              <td>

                                  <?php
                                    $sql_customer = "SELECT c_id, customername FROM  customer";
                                    $result_customer = $conn->query($sql_customer);
                                    ?>

                                  <select name="customer_name">
                                      <option value="Cash" default>Cash</option>

                                      <?php
                                        while ($row = mysqli_fetch_assoc($result_customer)) {
                                        ?>
                                          <option value="<?php echo $row['c_id']; ?>">
                                              <?php echo $row['customername']; ?>
                                          </option>
                                      <?php
                                        }
                                        ?>
                              </td>
                              <!-- <td><label for="product_category">Category:</label></td> -->
                              <!-- <td>
                                  <?php
                                    $sql_category = "SELECT cat_id, category_name FROM  category";
                                    $result_category = $conn->query($sql_category);
                                    ?>

                                  <select name="category">
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
                              </td> -->
                          </tr>

                          <tr>
                              <td><label for="discount_billing">Discount %:(optional)</label></td>
                              <td><input type="text" id="discount_billing" placeholder="Discount" name="discount" value="0"></td>
                              
                          </tr>

                          <tr>
                              <td><label for="total_amount">Total Amount:</label></td>
                              <td><input type="text" id="total_amount" readonly name="total_amount"></td>
                              <td><input type="submit" name="billing_submit" value="Submit " class="button_2"></td>
                          </tr>
                      </table>
                  </form>

              </div>
          </div>
      </div>
      </div>




      <script src="main.js"></script>
  </body>

  </html>