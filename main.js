window.onload = function() {
let datetime= new   Date();
let date_time=datetime.toLocaleTimeString;
document.getElementById("time").innerHTML=(date_time);
}