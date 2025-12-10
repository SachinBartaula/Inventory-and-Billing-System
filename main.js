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

function add_sales() {
  const itemsName = document.getElementById("product_name").value;
  const price = document.getElementById("product_price_billing").value;
  const quantity = document.getElementById("product_quantity_billing").value;
  const customerName = document.getElementById("customer_name").value;
  const totalAmount = document.getElementById("total_amount").value;

    if (itemsName === "") {
      alert("Please enter product name");
      return;
  }

  if (price === "" || isNaN(price)) {
      alert("Please enter a valid price");
      return;
  }

  if (quantity === "" || quantity <= 0) {
      alert("Please enter a valid quantity");
      return;
  }

  if (totalAmount === "" || isNaN(totalAmount)) {
      alert("Total amount is missing or invalid");
      return;
  }
  document.getElementById("customer_name_invoice").innerHTML = customerName;

  const tableBody = document.getElementById("invoice_items");

  const newRow = `
      <tr>
        <td>${itemsName}</td>
        <td>${quantity}</td>
        <td>${price}</td>
        <td>${totalAmount}</td>
      </tr>
  `;

  tableBody.insertAdjacentHTML("beforeend", newRow);

  // ---------------------sent info------------ 
  // document.getElementById("customer_name_database").value=customerName;

  updateTotals();
}
function updateTotals() {
  const taxOrNot=document.getElementById("tax_toggle").checked;
    let subtotal = 0;

    const rows = document.querySelectorAll("#invoice_items tr");

    rows.forEach(row => {
        let totalCell = row.children[3].innerText;
        subtotal += parseFloat(totalCell);
    });

    document.getElementById("subtotal").innerHTML = subtotal.toFixed(2);

    let tax=0;
    if (taxOrNot){
      tax = subtotal * 0.13;
      document.getElementById("tax").innerHTML = tax.toFixed(2);
    }

    let finalTotal = subtotal + tax;
    document.getElementById("final_total_amount").innerHTML = finalTotal.toFixed(2);

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