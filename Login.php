<?php
header("Content-Type: text/html; charset=UTF-8");
$user_id = $_POST['user_id_login'];
$user_pw = $_POST['user_pw_login'];

echo "<script>
    console.log('PHP_Console:".$user_id."');
    </script>";


// if($user_id==null || $user_pw==null)
// {
//     echo"<script>alert('빈칸을 채워주세요.'); document.location.href='Join.html';</script>";
//     exit();
// }

include "./inc/dbcon.php";

$sql= "SELECT user_pw FROM user WHERE user_id='".$user_id."'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo "<script>
    console.log('PHP_Console:".$row['user_pw']."');
    </script>";
    if ($user_pw ==$row['user_pw']){
        echo "<script>document.location.href='Mainpage.html';</script>";
    }else{
        echo"<script>alert('로그인 안됨어쩔'); document.location.href='Login.html';</script>";
    }
}

?>