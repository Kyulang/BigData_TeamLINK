<?php
header("Content-Type: text/html; charset=UTF-8");
session_start(); 
include "./inc/dbcon.php";

$delete_user_sql = "DELETE FROM patient_info
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql2 = "DELETE FROM user
WHERE user_id='".$_SESSION['user_id']."'";
mysqli_query($conn, $delete_user_sql);
mysqli_query($conn, $delete_user_sql2);

unset($_SESSION['user_id']);
session_destroy();

mysqli_close($conn);
echo "<script> alert(\"정상 처리 되었습니다.\");
document.location.href='Login.php';
</script>";
?>