// Inventory Form Validation
function inventory_validation(e) {
  let isValid = true;

  let productName = document.getElementById("product_name").value.trim();
  let productPrice = document.getElementById("product_price").value.trim();
  let productQuantity = document.getElementById("product_quantity").value.trim();
  let productCategory = document.querySelector("select[name='product_category']").value;
  let purchasedDate = document.getElementById("date").value.trim();

  // clear previous messages
  document.querySelectorAll(".validation_message").forEach(msg => msg.innerText = "");

  const productNamePattern = /^[A-Za-z]{3,}[A-Za-z0-9 ]*$/;

  /* Product Name */
  if (productName === "") {
    document.getElementById("validation_product_name").innerText =
      "Product name cannot be empty";
    isValid = false;
  } else if (!productNamePattern.test(productName)) {
    document.getElementById("validation_product_name").innerText =
      "Product name must be at least 3 characters and alphabates";
    isValid = false;
  }

  /* Price */
  if (productPrice === "") {
    showMessage("product_price", "Price is required");
    isValid = false;
  } else if (isNaN(productPrice) || Number(productPrice) <= 0) {
    showMessage("product_price", "Price must be a number greater than 0");
    isValid = false;
  }

  /* Quantity */
  if (productQuantity === "") {
    showMessage("product_quantity", "Quantity is required");
    isValid = false;
  } else if (isNaN(productQuantity) || Number(productQuantity) <= 0) {
    showMessage("product_quantity", "Quantity must be greater than 0");
    isValid = false;
  }

  /* Category */
  if (productCategory === "") {
    showMessage("product_category", "Please select a category");
    isValid = false;
  }

  /* Purchased Date */
  if (purchasedDate === "") {
    showMessage("date", "Purchased date is required");
    isValid = false;
  }

  return isValid; // submit only if ALL requirements pass
}


/* helper – DOES NOT change logic */
function showMessage(inputId, message) {
  let input = document.getElementById(inputId) || document.querySelector(`[name="${inputId}"]`);
  let msg = document.createElement("p");
  msg.className = "validation_message";
  msg.innerText = message;

  if (input && input.parentNode) {
    input.parentNode.appendChild(msg);
  }
}
// ------------------edit invenotry--------------
function clearMessages(form) {
    form.querySelectorAll(".validation_message").forEach(msg => msg.innerText = "");
}

function showMessageById(id, message) {
    const input = document.getElementById(id);
    if (!input) return;
    const msg = input.parentNode.querySelector(".validation_message");
    if (msg) msg.innerText = message;
}

function inventory_edit_validation(e) {
    const form = e.target;
    clearMessages(form);

    let isValid = true;

    let productName = document.getElementById("product_name").value.trim();
    let productPrice = document.getElementById("product_price").value.trim();
    let productQuantity = document.getElementById("product_quantity").value.trim();
    let productCategory = document.getElementById("product_category").value.trim();

    const productNamePattern = /^[a-zA-Z]{3,50}$/;

    if (productName === "") {
        showMessageById("product_name", "Product name cannot be empty");
        isValid = false;
    } else if (!productNamePattern.test(productName)) {
        showMessageById("product_name", "Product name must be 3-50 letters only");
        isValid = false;
    }

    if (productPrice === "" || isNaN(productPrice) || Number(productPrice) <= 0) {
        showMessageById("product_price", "Please enter a valid price greater than 0");
        isValid = false;
    }

    if (productQuantity === "" || isNaN(productQuantity) || Number(productQuantity) <= 0) {
        showMessageById("product_quantity", "Please enter a valid quantity greater than 0");
        isValid = false;
    }

    if (productCategory === "") {
        showMessageById("product_category", "Category cannot be empty");
        isValid = false;
    }

    // ✅ Submit form normally if valid
    return isValid;
}

// Category Form Validation
function clearCategoryMessages(form) {
    form.querySelectorAll(".validation_message").forEach(msg => msg.innerText = "");
}

function showCategoryMessageById(id, message) {
    const input = document.getElementById(id);
    if (!input) return;
    let msg = input.parentNode.querySelector(".validation_message");

    // If <p> doesn't exist, create it dynamically
    if (!msg) {
        msg = document.createElement("p");
        msg.className = "validation_message";
        input.parentNode.appendChild(msg);
    }
    msg.innerText = message;
}

function category_validation(e) {
    const form = e.target;
    clearCategoryMessages(form);
    let isValid = true;

    let categoryName = document.getElementById("Category_name").value.trim();
    let createdOn = document.getElementById("catogary_date").value.trim();

    if (categoryName === "") {
        showCategoryMessageById("Category_name", "Category name cannot be empty");
        isValid = false;
    } else if (categoryName.length < 3) {
        showCategoryMessageById("Category_name", "Category name must be at least 3 characters long");
        isValid = false;
    } else if (categoryName.length > 50) {
        showCategoryMessageById("Category_name", "Category name cannot exceed 50 characters");
        isValid = false;
    }

    const pattern = /^[a-zA-Z]+$/;
    if (!pattern.test(categoryName)) {
        showCategoryMessageById("Category_name", "Category name should start with a letter");
        isValid = false;
    }

    if (createdOn === "") {
        showCategoryMessageById("catogary_date", "Created date is required");
        isValid = false;
    }

    return isValid;
}

// ---------------------------employee---------------------
function clearEmployeeMessages(form) {
    form.querySelectorAll(".validation_message").forEach(msg => msg.innerText = "");
}

function showEmployeeMessageById(id, message) {
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
function employee_validation(e) {
    const form = e.target;
    clearEmployeeMessages(form);
    let isValid = true;

    let username = document.getElementById("e_username").value.trim();
    let password = document.getElementById("e_password").value.trim();
    let role = document.getElementById("role").value.trim();

    const usernamePattern = /^[a-zA-Z]{3,49}\d?$/;
    const passwordPattern = /^[a-zA-Z].{3,}$/; // starts with letter + at least 4 chars

    // Username validation
    if (username === "") {
        showEmployeeMessageById("e_username", "Please enter a username");
        isValid = false;
    } else if (!usernamePattern.test(username)) {
        showEmployeeMessageById("e_username", "Username must be 3-50 letters (may end with a number)");
        isValid = false;
    }

    // Password validation
    if (password === "") {
        showEmployeeMessageById("e_password", "Please enter a password");
        isValid = false;
    } else if (!passwordPattern.test(password)) {
        showEmployeeMessageById("e_password", "Password must start with a letter and be at least 3 characters long");
        isValid = false;
    }

    // Role validation
    if (role === "") {
        showEmployeeMessageById("role", "Role cannot be empty");
        isValid = false;
    }

    return isValid;
}

// --------------------------------------customer-------------------------
function clearCustomerMessages(form) {
    form.querySelectorAll(".validation_message").forEach(msg => msg.innerText = "");
}

function showCustomerMessageById(id, message) {
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

function customer_validation(e) {
    const form = e.target;
    clearCustomerMessages(form);
    let isValid = true;

    let name = document.getElementById("c_name").value.trim();
    let phone = document.getElementById("c_phone").value.trim();
    let address = document.getElementById("c_address").value.trim();

    // Name validation
    if (name === "") {
        showCustomerMessageById("c_name", "Customer name is required");
        isValid = false;
    } else if (!/^[a-zA-Z]{3,49}\d?$/.test(name)) {
        showCustomerMessageById("c_name", "Name should contain letters only and 3-50 characters");
        isValid = false;
    }

    // Phone validation
    if (phone === "") {
        showCustomerMessageById("c_phone", "Phone number is required");
        isValid = false;
    } else if (!/^[0-9]{10}$/.test(phone)) {
        showCustomerMessageById("c_phone", "Phone must be 10 digits");
        isValid = false;
    }

    // Address validation
    if (address === "") {
        showCustomerMessageById("c_address", "Address is required");
        isValid = false;
    } else if (!/^[a-zA-Z][a-zA-Z0-9\s,.\-\/]*$/.test(address)) {
    showCustomerMessageById(
        "c_address", 
        "Address should start with a letter and can be alphanumeric "
    );
    isValid = false;
} 
// Minimum length check
else if (address.length < 5) {
    showCustomerMessageById("c_address", "Address must be at least 5 characters long");
    isValid = false;
}
    return isValid;
}
