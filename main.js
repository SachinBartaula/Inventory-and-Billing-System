window.onload=function(){
    function clock() {
        var time = new Date();
        document.getElementById("hrs").innerHTML = time.getHours() + ":";
        document.getElementById("min").innerHTML = time.getMinutes() + ":";
        document.getElementById("sec").innerHTML = time.getSeconds();
    }
    clock();
    setInterval(clock, 1000);
}
