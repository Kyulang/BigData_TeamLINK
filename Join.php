<?php
header("Content-Type: text/html; charset=UTF-8");
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

if($user_id==null || $user_pw==null)
{
    echo"<script>alert('빈칸을 채워주세요.'); document.location.href='Join.html';</script>";
    exit();
}

include "./inc/dbcon.php";

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
?>

<HTML>
    <HEAD>
        <meta charset="UTF-8">
        <TITLE>회원가입</TITLE>
    </HEAD>
    <BODY>
        <form action="Join.php" method="post">
        <h1> 회원가입 </h1>
        사용할 아이디 입력 <INPUT TYPE="TEXT" NAME="USER_ID"><BR>
        사용할 비밀번호 입력 <INPUT TYPE="TEXT" NAME="USER_PW"><BR>
        <INPUT TYPE="SUBMIT" VALUE="회원가입"> <INPUT TYPE = "reset" value="취소"><BR>

        </form>
    </BODY>
</HTML>

