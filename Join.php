<?php
header("Content-Type: text/html; charset=UTF-8");
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

if($user_id==null || $user_pw==null)
{
    echo"<script>alert('빈칸을 채워주세요.'); document.location.href='Join.html';</script>";
    exit();
}

$conn = mysqli_connect(
    'localhost',
    'root', //user name
    'team03', //db password
    'team03' //db name
)

$sql = "
INSERT INTO users
 (user_id, user_pw)
 VALUES(
     '{$_POST['user_id']}',
     '{$_POST['user_pw']}'
    )
";

$result = mysqli_query($conn, $sql);
if ($result == false) {
    echo"<script>alert('아이디가 중복됩니다.'); document.location.href='Join.html';</script>";
    error_log(myspli_error($conn));
}else{
    echo"<script>alert('회원가입이 완료되었습니다.'); document.location.href='Login.html';</script>";
}