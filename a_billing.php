  <?php
    session_start();

    if (!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "admin") {
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
                  <h4><?php echo
                        $_SESSION["username_session"]; ?></h4>
              </div>
          </div>
          <div class="billing">
              <!-- <form> -->

              <div class="form-group">
                  <label for="date">Date:</label>
                  <input type="date" id="date" name="salse_date" readonly>
              </div>

              <div class="form-row">
                  <div class="form-group">
                      <label for="product_name">Product Name:</label>
                      <input type="text" id="product_name" name="product_name" placeholder="Product Name" required>
                  </div>

                  <div class="form-group">
                      <label for="product_price_billing">Price:</label>
                      <input type="text" id="product_price_billing" name="product_price" placeholder="Price" required>
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-group">
                      <label for="product_quantity_billing">Quantity:</label>
                      <input type="number" id="product_quantity_billing" name="product_quantity" value="1" required>
                  </div>

                  <div class="form-group">
                      <label for="customer_name">Customer:</label>
                      <select name="customer_name" id="customer_name">
                          <option value="Cash">Cash</option>
                          <?php
                            $sql_customer = "SELECT c_id, customername FROM customer";
                            $result_customer = $conn->query($sql_customer);
                            while ($row = mysqli_fetch_assoc($result_customer)) {
                            ?>
                              <option value=<?php echo htmlspecialchars($row['customername']); ?>>
                                  <?php echo  $row['customername']; ?>
                              </option>
                          <?php } ?>
                      </select>
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-group">
                      <label for="discount_billing">Discount % (optional):</label>
                      <input type="text" id="discount_billing" name="discount" placeholder="Discount" value="0">
                  </div>
                  <div class="form-group">
                      <label>Apply Tax:</label>
                      <label class="switch">
                          <input type="checkbox" id="tax_toggle" onchange="updateTotals()">
                          <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="form-group">
                      <label for="total_amount">Total Amount:</label>
                      <input type="text" id="total_amount" name="total_amount" readonly>
                  </div>
              </div>

              <div class="form-group">

                  <button type="submit" name="billing_submit" class="billing-btn" onclick="add_sales()">Add</button>
                
              </div>

              <!-- </form> -->
          </div>

      </div>

      <!-- ---------------------invoice----------------------------  -->

      <div class="invoice-box">
          <h1>Invoice</h1>

          <table class="details">
              <tr>
                  <td>
                      <strong>Inventory & Billing system</strong><br>
                  </td>
                  <td>
                      <strong>Invoice #:</strong> 001<br>
                      <strong>Date:</strong> <span id="date_text"></span><br>
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
                      <strong>Bill To:</strong>
                      <p id="customer_name_invoice"></p><br>
                  </td>
              </tr>
          </table>
          <table class="items">
              <tr>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Total</th>
              </tr>

              <tbody id="invoice_items"></tbody>
          </table>


          <table class="totals">
              <tr>
                  <td>Subtotal:</td>
                  <td id=subtotal></td>
              </tr>
              <tr>
                  <td>Tax:(13%)</td>
                  <td id="tax"></td>
              </tr>
              <tr>
                  <td><strong>Total:</strong></td>
                  <td id="final_total_amount"><strong></strong></td>
              </tr>
          </table>


          <p><strong>Sales by: </strong> <?php echo
                                            $_SESSION["username_session"]; ?> </p>
      </div>
      </div>
      <!-- ------------------------hidden form to sent data ---------------  -->

        <!-- <form method="post">

           <input type="text" id="product_name_database" name="product_name" placeholder="Product Name" required>
           <input type="text" id="product_price_database" name="product_price" placeholder="Price" required>
           <input type="number" id="product_quantity_database" name="product_quantity" value="1" required>
           <input type="text" name="customer_name" id="customer_name_database">
               <input type="text" id="total_amount_database" name="total_amount" readonly>
            </form> -->
                      
      <script src="main.js"></script>
  </body>

  </html>