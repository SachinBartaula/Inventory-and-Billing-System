<?php
 $servername="localhost:3308";
    $dusername="root";
    $dpassword="";
    $dname="project";
    
    $conn=new mysqli($servername,$dusername,$dpassword,$dname);
    if($conn->connect_errno !=0)
        {
            die("connection failed".$conn->connect_error);
        }
?>