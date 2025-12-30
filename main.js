// --------------------------------- CLOCK ---------------------------------
window.addEventListener("load", function () {
  function clock() {
    const time = new Date();
    let hrs = time.getHours();
    const min = String(time.getMinutes()).padStart(2, "0");
    const sec = String(time.getSeconds()).padStart(2, "0");
    const ampm = hrs >= 12 ? "PM" : "AM";

    hrs = hrs % 12 || 12; // 24hr to 12hr
    hrs = String(hrs).padStart(2, "0");

    document.getElementById("hrs").innerHTML = hrs + ":";
    document.getElementById("min").innerHTML = min + ":";
    document.getElementById("sec").innerHTML = sec;
    document.getElementById("ampm").innerHTML = ampm;
  }
  clock();
  setInterval(clock, 1000);
});

//table---------------------------------
$(document).ready(function() {
    $('#salesTable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 10
    });

    $('#inventoryTable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 10
    });
     $('#mytable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 10
    });
      $('#mytable_customer').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 10
    });
});

// -------------------------- BILLING DATE SETUP --------------------------
window.addEventListener("load", function () {
  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, "0");
  const day = String(today.getDate()).padStart(2, "0");
  const fullDate = `${year}-${month}-${day}`;

  document.getElementById("date").value = fullDate;
  document.getElementById("catogary_date").value = fullDate;
  document.getElementById("employee_createdOn").value = fullDate;
  document.getElementById("date_text").innerHTML = fullDate;
  document.getElementById("Salse_on").value = fullDate;
});

// -------------------------- REAL-TIME TOTAL CALC --------------------------
function calculateTotal() {
  let price = parseFloat(document.getElementById("product_price_billing").value) || 0;
  let quantity = parseInt(document.getElementById("product_quantity_billing").value) || 0;
  let discount = parseFloat(document.getElementById("discount_billing").value) || 0;

  let total = price * quantity;
  if (discount > 0) {
    total = total - total * (discount / 100);
  }
  document.getElementById("total_amount").value = total.toFixed(2);
}

document.getElementById("product_price_billing").addEventListener("input", calculateTotal);
document.getElementById("product_quantity_billing").addEventListener("input", calculateTotal);
document.getElementById("discount_billing").addEventListener("input", calculateTotal);

// -------------------------- ADD ITEM TO INVOICE --------------------------
let count = 1;
function showBillingMessageById(id, message) {
    const input = document.getElementById(id);
    if (!input) return;
    let msg = input.parentNode.querySelector(".validation_message");
    if (!msg) {
        msg = document.createElement("p");
        msg.className = "validation_message";
        input.parentNode.appendChild(msg);
    }
    msg.innerText = message;
}

function clearBillingMessages() {
    document.querySelectorAll(".validation_message").forEach(msg => msg.innerText = "");
}

function add_sales() {
    clearBillingMessages();

    const product = document.getElementById("product_name").value.trim();
    const price = parseFloat(document.getElementById("product_price_billing").value);
    const qty = parseFloat(document.getElementById("product_quantity_billing").value);
    const discount = parseFloat(document.getElementById("discount_billing").value) || 0;
    const customer = document.getElementById("customer_name").value.trim();

    let isValid = true;

    if (!product) {
        showBillingMessageById("product_name", "Please enter a product name.");
        isValid = false;
    }

    if (isNaN(price) || price <= 0) {
        showBillingMessageById("product_price_billing", "Please enter a valid price greater than 0.");
        isValid = false;
    }

    if (isNaN(qty) || qty <= 0) {
        showBillingMessageById("product_quantity_billing", "Please enter a valid quantity greater than 0.");
        isValid = false;
    }

    if (isNaN(discount) || discount < 0 || discount > 100) {
        showBillingMessageById("discount_billing", "Please enter a valid discount between 0 and 100.");
        isValid = false;
    }

    if (!customer) {
        showBillingMessageById("customer_name", "Please enter a customer name.");
        isValid = false;
    }

    if (!isValid) return false; // Stop if validation failed

    // If all validations pass, you can proceed

    // Apply discount
    let total = price * qty;
    if (discount > 0) {
        total = total - total * (discount / 100);
    }
    total = total.toFixed(2);

    document.getElementById("customer_name_invoice").innerText = customer;

    const tbody = document.getElementById("invoice_items");
    tbody.insertAdjacentHTML("beforeend", `<tr>
        <td>${count}</td>
        <td>${product}</td>
        <td>${qty}</td>
        <td>${price.toFixed(2)}</td>
        <td>${total}</td>
    </tr>`);
    count++;
    updateTotals();
}


// -------------------------- UPDATE SUBTOTAL, TAX, FINAL --------------------------
function updateTotals() {
  const taxEnabled = document.getElementById("tax_toggle").checked;
  let subtotal = 0;
  document.querySelectorAll("#invoice_items tr").forEach(r => {
    subtotal += parseFloat(r.children[4].innerText);
  });

  const tax = taxEnabled ? subtotal * 0.13 : 0;
  const finalTotal = subtotal + tax;

  document.getElementById("subtotal").innerText = subtotal.toFixed(2);
  document.getElementById("tax").innerText = tax.toFixed(2);
  document.getElementById("final_total_amount").innerText = finalTotal.toFixed(2);

  // Set hidden fields for PHP
  document.getElementById("subtotal_amount").value = subtotal.toFixed(2);
  document.getElementById("tax_amount").value = tax.toFixed(2);
  document.getElementById("final_total").value = finalTotal.toFixed(2);
}

// -------------------------- PREPARE INVOICE DATA FOR PHP --------------------------
function prepareInvoiceData() {
  const items = [];
  document.querySelectorAll("#invoice_items tr").forEach(r => {
    items.push({
      product_name: r.children[1].innerText,
      quantity: r.children[2].innerText,
      price: r.children[3].innerText,
      total: r.children[4].innerText
    });
  });

  if (items.length === 0) {
    alert("Add at least one item before saving invoice!");
    return false; // prevent submit
  }

  document.getElementById("invoice_data").value = JSON.stringify(items);
  return true; // allow submit
}

function print_function(){
  window.print();
}
// ----------------model---------------------
function additems() {
   document.getElementById("addinventory_id").classList.add("show");
}

function closeitems(){
   document.getElementById("addinventory_id").classList.add("close");

}

function addcategory() {
  document.getElementById("category_add")?.classList.add("show_category");
}

function closecategory() {
  document.getElementById("category_add")?.classList.remove("show_category");
}
// ------------------------------- EMPLOYEES -----------------------------------
function addemployee() {
  document.getElementById("emp_form_container")?.classList.add("show");
}

function closeemployee() {
  document.getElementById("emp_form_container")?.classList.remove("show");
}

// -------------------------------- CUSTOMER ----------------------------------
function addCustomer() {
  document.getElementById("customer_form_container")?.classList.add("show");
}

function closeCustomer() {
  document.getElementById("customer_form_container")?.classList.remove("show");
}