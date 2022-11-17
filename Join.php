<?php
header("Content-Type: text/html; charset=UTF-8");

$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

if (isset($_POST['submitted_add_m'])){
    $sql = "INSERT INTO member_info (user_id, user_pw) VALUES(?, ?)";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("ss", $user_id, $user_pw);
        $user_id = $_REQUEST['user_id'];
        $user_pw = $_REQUEST['user_pw'];
        if($user_id==null || $user_pw==null)
        {
            echo"<script>alert('빈칸을 채워주세요.'); document.location.href='Join.php';</script>";
            exit();
        }
        if (mysqli_stmt_execute($stmt)){
            
            $info_sql = "INSERT INTO bio_info (`patient_id`) VALUES ('{$_REQUEST['user_id']}')";
            $cancer_sql = "INSERT INTO cancer_info (patient_id) VALUES('{$_REQUEST['user_id']}')";
            $surgery_sql = "INSERT INTO surgery_info (patient_id) VALUES('{$_REQUEST['user_id']}')";
            $r2 = mysqli_query($conn, $info_sql);
            $r2 = mysqli_query($conn, $cancer_sql);
            $r2 = mysqli_query($conn, $surgery_sql);
            echo"<script>alert('회원가입이 완료되었습니다.'); document.location.href='Login.php';</script>";
            mysqli_close($conn);
        }
        else{
            echo"<script>alert('아이디가 중복됩니다.'); document.location.href=Join.php';</script>";
            error_log(myspli_error($conn));
        }
    }
}
?>
<h1> 회원가입 </h1>
<form action="./Join.php" method="post">
        사용할 아이디 입력 <INPUT TYPE="TEXT" NAME="user_id"><BR>
        사용할 비밀번호 입력 <INPUT TYPE="TEXT" NAME="user_pw"><BR>
        <INPUT TYPE="SUBMIT" VALUE="회원가입"> 
        <INPUT TYPE = "reset" value="취소"><BR>
        <input type="hidden" name="submitted_add_m" value="TRUE"/>
    </form>
    <button type="button" name="go_Login" onClick="location.href='./Login.php'">로그인</button><BR>

