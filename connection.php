<?php
 $servername="localhost:3306";
    $dusername="root";
    $dpassword="";
    $dname="Inventory_and_Billing_System";
    
    $conn=new mysqli($servername,$dusername,$dpassword,$dname);
    if($conn->connect_errno !=0)
        {
            die("connection failed".$conn->connect_error);
        }
?>