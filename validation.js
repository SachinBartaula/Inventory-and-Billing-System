// Inventory Form Validation
function inventory_validation(e) {
    let productName = document.getElementById("product_name").value.trim();
    let productPrice = document.getElementById("product_price").value.trim();
    let productQuantity = document.getElementById("product_quantity").value.trim();
    let productCategory = document.querySelector("select[name='product_category']").value;
    let purchasedDate = document.getElementById("purchased_date").value.trim();

    // Product name pattern: only letters, 3-50 characters
    const productNamePattern = /^[a-zA-Z]{3,50}$/;

    if (productName === "") {
        alert("Product name cannot be empty");
        document.getElementById("product_name").focus();
        return false;
    }

    if (!productNamePattern.test(productName)) {
        alert("Product name must be 3-50 letters and contain letters only");
        document.getElementById("product_name").focus();
        return false;
    }

    if (productPrice === "" || isNaN(productPrice) || Number(productPrice) <= 0) {
        alert("Please enter a valid price greater than 0");
        document.getElementById("product_price").focus();
        return false;
    }

    if (productQuantity === "" || isNaN(productQuantity) || Number(productQuantity) <= 0) {
        alert("Please enter a valid quantity greater than 0");
        document.getElementById("product_quantity").focus();
        return false;
    }

    if (productCategory === "") {
        alert("Please select a category");
        document.querySelector("select[name='product_category']").focus();
        return false;
    }

    if (purchasedDate === "") {
        alert("Purchased date is required");
        document.getElementById("purchased_date").focus();
        return false;
    }

    return true; // everything is valid → submit form
}

// ---------------------edit inventory----------------------
function inventory_edit_validation(e) {
    let productName = document.getElementById("product_name").value.trim();
    let productPrice = document.getElementById("product_price").value.trim();
    let productQuantity = document.getElementById("product_quantity").value.trim();
    let productCategory = document.getElementById("product_category").value.trim();
    let purchasedDate = document.getElementById("purchased_date").value.trim();

    const productNamePattern = /^[a-zA-Z]{3,50}$/; // 3-50 letters only

    if (productName === "") {
        alert("Product name cannot be empty");
        document.getElementById("product_name").focus();
        return false;
    }

    if (!productNamePattern.test(productName)) {
        alert("Product name must be 3-50 letters only");
        document.getElementById("product_name").focus();
        return false;
    }

    if (productPrice === "" || isNaN(productPrice) || Number(productPrice) <= 0) {
        alert("Please enter a valid price greater than 0");
        document.getElementById("product_price").focus();
        return false;
    }

    if (productQuantity === "" || isNaN(productQuantity) || Number(productQuantity) <= 0) {
        alert("Please enter a valid quantity greater than 0");
        document.getElementById("product_quantity").focus();
        return false;
    }

    if (productCategory === "") {
        alert("Category cannot be empty");
        document.getElementById("product_category").focus();
        return false;
    }
    return true; // all valid → submit form
}

// Category Form Validation

function category_validation(e) {
    let categoryName = document.getElementById("Category_name").value.trim();
    let createdOn = document.getElementById("Salse_on").value.trim();

    // Check if empty
    if (categoryName === "") {
        alert("Category name cannot be empty");
        document.getElementById("Category_name").focus();
        e.preventDefault();
        return false;
    }

    // Optional: check length
    if (categoryName.length < 3) {
        alert("Category name must be at least 3 characters long");
        document.getElementById("Category_name").focus();
        e.preventDefault();
        return false;
    }

    if (categoryName.length > 50) {
        alert("Category name cannot exceed 50 characters");
        document.getElementById("Category_name").focus();
        e.preventDefault();
        return false;
    }

    // Optional: allow only letters, numbers, and spaces
    const pattern = /^[a-zA-Z ]+$/;
    if (!pattern.test(categoryName)) {
        alert("Category name can only contain letters, numbers, and spaces");
        document.getElementById("Category_name").focus();
        e.preventDefault();
        return false;
    }

    // Check created date
    if (createdOn === "") {
        alert("Created date is required");
        document.getElementById("Salse_on").focus();
        e.preventDefault();
        return false;
    }

    return true; // everything is fine, allow form submission
}


// ---------------------------employee---------------------
function employee_validation(e) {
    let username = document.getElementById("e_username").value.trim();
    let password = document.getElementById("e_password").value.trim();
    let role = document.getElementById("role").value.trim();
    let createdOn = document.getElementById("Salse_on").value.trim();

    // Patterns
    // Username: 3-50 letters (a-zA-Z) and optionally end with 1 number
    let usernamePattern = /^[a-zA-Z]{3,49}\d?$/;

    // Password: at least 6 characters
    let passwordPattern = /^.{6,}$/;

    // Username validation
    if (username === "") {
        alert("Please enter a username");
        document.getElementById("e_username").focus();
        return false;
    }

    if (!usernamePattern.test(username)) {
        alert("Username must be 3-50 letters (A-Z, a-z) and may optionally end with a number");
        document.getElementById("e_username").focus();
        return false;
    }

    // Password validation
    if (password === "") {
        alert("Please enter a password");
        document.getElementById("e_password").focus();
        return false;
    }

    if (!passwordPattern.test(password)) {
        alert("Password must be at least 6 characters long");
        document.getElementById("e_password").focus();
        return false;
    }

    // Role validation
    if (role === "") {
        alert("Role cannot be empty");
        return false;
    }

    // Created on validation
    if (createdOn === "") {
        alert("Created date is required");
        return false;
    }

    return true; // All valid
}

// --------------------------------------customer-------------------------
function customer_validation(e) {

    // Get values
    let name = document.getElementById("c_name").value.trim();
    let phone = document.getElementById("c_phone").value.trim();
    let address = document.getElementById("c_address").value.trim();

    // Name validation
    if (name === "") {
        alert("Customer name is required");
        return false;
    }
    if (!/^[a-zA-Z]{3,49}\d?$/.test(name)) {
        alert("Name should contain letters only");
        return false;
    }

    // Phone validation
    if (phone === "") {
        alert("Phone number is required");
        return false;
    }
    if (!/^[0-9]{10}$/.test(phone)) {
        alert("Phone must be digits only (7-15 digits)");
        return false;
    }

    // Address validation
    if (address === "") {
        alert("Address is required");
        return false;
    }

    // If all ok → submit form
    return true;
}
