<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
$user_id = $session["user_id"];

$age = $_POST["u_age"];
$sex = $_POST["u_sex"];
$height = $_POST["u_height"];
$weight = $_POST["u_weight"];
$marry = $_POST["u_marry"];
$cs_stage = $_POST["u_cs_stage"];
$hospital = $_POST["u_hospotal"];

// 값 확인 
echo "나이: ".$age.<br>;
echo "성별: ".$sex.<br>;
echo "키: ".$height.<br>;
echo "체중: ".$weight.<br>;
echo "결혼여부: ".$marry.<br>;
echo "스테이지: ".$cs_stage.<br>;
echo "병원: ".$hospital.<br>;


// db접속
$conn = mysqli_connect(
    'localhost',
    'root', //user name
    'team03', //db password
    'team03' //db name
)

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
   }

$sql = "update user set age='$age', sex = '$sex', height='$height', weight = '$weight', marry='$marry', cs_stage = '$cs_stage', hospital = '$hostpital'";

echo sql;

mysqli_query($conn, $sql);

mysqli_close($conn);

//리디렉션
echo"
   <script type=\"text/javascript\">
        alert(\"정보가 수정되었습니다.\");
        location.href = \"MyPage.html\";
    </script>
    ";
?>
