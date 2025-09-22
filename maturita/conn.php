<?php
    $conn = mysqli_connect("localhost", "root", "", "mydb");
    $db = mysqli_select_db($conn, 'mydb'); 
   if($conn->connect_error ) {
        printf("Connect failed: %s<br />", $conn->connect_error);
        exit();
   }
    
?>
