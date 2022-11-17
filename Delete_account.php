<?php
header("Content-Type: text/html; charset=UTF-8");
session_start(); 
include "./inc/dbcon.php";

$delete_user_sql = "DELETE FROM Member_info
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql2 = "DELETE FROM bio_info
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql3 = "DELETE FROM cancer_info
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql4 = "DELETE FROM hospital_info
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql5 = "DELETE FROM surgery_info
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql6 = "DELETE FROM treatment_info
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql7 = "DELETE FROM chemotherapy
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql8 = "DELETE FROM hormone_therapy
WHERE user_id='".$_SESSION['user_id']."'";
$delete_user_sql9 = "DELETE FROM radio_therapy
WHERE user_id='".$_SESSION['user_id']."'";

mysqli_query($conn, $delete_user_sql);
mysqli_query($conn, $delete_user_sql2);
mysqli_query($conn, $delete_user_sql3);
mysqli_query($conn, $delete_user_sql4);
mysqli_query($conn, $delete_user_sql5);
mysqli_query($conn, $delete_user_sql6);
mysqli_query($conn, $delete_user_sql7);
mysqli_query($conn, $delete_user_sql8);
mysqli_query($conn, $delete_user_sql9);


unset($_SESSION['user_id']);
session_destroy();

mysqli_close($conn);
echo "<script> alert(\"정상 처리 되었습니다.\");
document.location.href='Login.php';
</script>";
?>
