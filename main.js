// -------------------------------------clock---------------------------------
window.addEventListener("load" ,function () {
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
// ------------------------inventory---------------------------
function additems() {
    document.getElementById("addinventory_id").classList.add("show");
}
function closeitems(){
    document.getElementById("addinventory_id").classList.add("close");
    
}
window.addEventListener("load", function () {
    const time = new Date();
    const fulldate = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();
    document.getElementById("purchased_date").value = fulldate;
});

// --------------------------billing----------------------------------

window.addEventListener("load", function () {
    const time = new Date();
    const fulldate = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();
    document.getElementById("Salse_on").value = fulldate;

});
// -------------------------------employees--------------------------------
function addemployee(){
    document.getElementById("emp_form_container").classList.add("show");
}
function closeemployee(){
    document.getElementById("emp_form_container").classList.add("close");
    
}

window.addEventListener("load", function () {
    const time = new Date();
    const fulldate = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();
    document.getElementById("emp_created_on").value = fulldate;
});