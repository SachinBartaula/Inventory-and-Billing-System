// -------------------------------------clock---------------------------------
window.addEventListener("load", function () {
  function clock() {
    const time = new Date();
    let hrs = time.getHours();
    const min = String(time.getMinutes()).padStart(2, "0");
    const sec = String(time.getSeconds()).padStart(2, "0");
    const ampm = hrs >= 12 ? "PM" : "AM";

    hrs = hrs % 12 || 12; // Convert 24hr to 12hr format
    hrs = String(hrs).padStart(2, "0");

    document.getElementById("hrs").innerHTML = hrs + ":";
    document.getElementById("min").innerHTML = min + ":";
    document.getElementById("sec").innerHTML = sec;
    document.getElementById("ampm").innerHTML = ampm;
  }

  clock();
  setInterval(clock, 1000);
});
window.addEventListener("load", function () {
  let salesTable = new DataTable("#salesTable");
  let inventoryTable = new DataTable("#inventoryTable");
  let customerTable = new DataTable("#customerTable");
});
// ------------------------inventory---------------------------
function additems() {
  document.getElementById("addinventory_id").classList.add("show");
}

function addcategory() {
  document.getElementById("category_add").classList.add("show_category");
}

// --------------------------billing----------------------------------

window.addEventListener("load", function () {
  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, "0");
  const day = String(today.getDate()).padStart(2, "0");

  const fullDate = `${year}-${month}-${day}`;
  document.getElementById("date").value = fullDate;
  document.getElementById("date_text").innerHTML = fullDate;
  document.getElementById("catogary_date").value = fullDate;
});

//real time calculation
function calculateTotal() {
  let price =
    parseFloat(document.getElementById("product_price_billing").value) || 0;
  let quantity =
    parseInt(document.getElementById("product_quantity_billing").value) || 0;
  let discount =
    parseFloat(document.getElementById("discount_billing").value) || 0;

  let total = price * quantity;

  // apply discount if entered
  if (discount > 0) {
    total = total - total * (discount / 100);
  }

  document.getElementById("total_amount").value = total.toFixed(2);
}

// Run calculation whenever user types
document
  .getElementById("product_price_billing")
  .addEventListener("input", calculateTotal);
document
  .getElementById("product_quantity_billing")
  .addEventListener("input", calculateTotal);
document
  .getElementById("discount_billing")
  .addEventListener("input", calculateTotal);

  let count = 1;

function add_sales() {
    const product = document.getElementById("product_name").value;
    const price = parseFloat(document.getElementById("product_price_billing").value);
    const qty = parseFloat(document.getElementById("product_quantity_billing").value);
    const customer = document.getElementById("customer_name").value;

    if (!product || isNaN(price) || isNaN(qty) || qty <= 0) {
        alert("Enter valid product, price, and quantity");
        return;
    }

    const total = (price * qty).toFixed(2);
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

    // Hidden inputs for PHP
    document.getElementById("subtotal_amount").value = subtotal.toFixed(2);
    document.getElementById("tax_amount").value = tax.toFixed(2);
    document.getElementById("final_total").value = finalTotal.toFixed(2);
}

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
// -------------------------------employees--------------------------------
function addemployee() {
  document.getElementById("emp_form_container").classList.add("show");
}
function closeemployee() {
  document.getElementById("emp_form_container").classList.add("close");
}
// ------------------------------------customer------------------------
function addCustomer() {
  document.getElementById("customer_form_container").classList.add("show");


}
// ---------------------------------view bills----------------------

function print_function(){
  window.print();
}