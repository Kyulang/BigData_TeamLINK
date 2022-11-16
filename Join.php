<?php
header("Content-Type: text/html; charset=UTF-8");
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

echo $user_id;
echo $user_pw;

if($user_id==null || $user_pw==null)
{
    echo"<script>alert('빈칸을 채워주세요.'); document.location.href='Join.html';</script>";
    exit();
}

include "./inc/dbcon.php";

$sql = "
INSERT INTO user
 (user_id, user_pw)
 VALUES(
     '{$_POST['user_id']}',
     '{$_POST['user_pw']}'
    )
";

$result = mysqli_query($conn, $sql);
if ($result == false) {
    echo"<script>alert('아이디가 중복됩니다.'); document.location.href=Join.php';</script>";
    error_log(myspli_error($conn));
}else{
    echo"<script>alert('회원가입이 완료되었습니다.'); document.location.href='Login.html';</script>";
    $info_sql = "INSERT INTO patient_info (user_id) 
    VALUES('{$_POST['user_id']}')";
    $r2 = mysqli_query($conn, $info_sql);
}
?>


