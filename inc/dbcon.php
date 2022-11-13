<?php
$conn = mysqli_connect(
    'localhost',
    'team03', //user name
    'team03', //db password
    'team03' //db name
)

mysqli_set_charset($conn, "utf8");

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
   }
?>