<?php
header("Content-Type: text/html; charset=UTF-8");

$page_title = 'MyPage';
include('./inc/header.php');

include "./inc/dbcon.php";
?>

<h1> My Page </h1>
<h2> 나의 기본정보</h2>
<table >
<?php
$sql_stat = "SELECT * FROM bio_info WHERE patient_id='".$_SESSION['user_id']."'";
$result_stat = mysqli_query($conn, $sql_stat);


while($row = mysqli_fetch_array($result_stat, MYSQLI_ASSOC)){
    echo "<tr><td> ID </td><td>{$row['patient_id']}</td></tr>";
    echo "<tr><td> AGE </td> <td>{$row['age']}</td></tr>";
    echo "<tr><td> Marriage </td> <td>{$row['marital_status']}</td></tr>";
    echo "<tr><td> height </td> <td>{$row['height']}</td></tr>";
    echo "<tr><td> weight </td> <td>{$row['weight']}</td></tr>";
}
echo "</table>";
?>
<button type="button" name="update_state" onClick="location.href='Mypage_status_update.php'">업데이트</button>

<h2> 나의 병정보</h2>
<table >
<?php 
    $sql_hos = "SELECT * FROM cancer_info WHERE patient_id='".$_SESSION['user_id']."'";
    $result_hos = mysqli_query($conn, $sql_hos);

    while($row = mysqli_fetch_array($result_hos, MYSQLI_ASSOC)){
        echo "<tr><td> 암 기수 </td><td>{$row['tumor_stage']}</td></tr>";
        echo "<tr><td> 암 크기 </td> <td>{$row['tumor_size']}</td></tr>";
        echo "<tr><td> 재발여부 </td> <td>{$row['relapse_free_status']}</td></tr>";
        echo "<tr><td> 비재발기간 </td> <td>{$row['relapse_free_months']}</td></tr>";
        echo "<tr><td> 생존여부 </td> <td>{$row['vital_status']}</td></tr>";
    }
    echo "</table>";
?>
</table>

<button type="button" name="update_state" onClick="location.href='Mypage_cancer_update.php'">업데이트</button>
<h2> 나의 병원 정보</h2>
<!-- 담당의, 연락처 -->
<table >
<?php 
    $sql_hos = "SELECT * FROM hospital_info WHERE patient_id='".$_SESSION['user_id']."'";
    $result_hos = mysqli_query($conn, $sql_hos);

    while($row = mysqli_fetch_array($result_hos, MYSQLI_ASSOC)){
        echo "<tr><td> 병원 이름 </td><td>{$row['hospital']}</td></tr>";
        echo "<tr><td> 병동(병실) </td> <td>{$row['rooms']}</td></tr>";
        echo "<tr><td> 입원날짜 </td> <td>{$row['admission']}</td></tr>";
        echo "<tr><td> 퇴원날짜 </td> <td>{$row['discharge']}</td></tr>";
    }
    echo "</table>";
?>
</table>
<button type="button" name="update_state" onClick="location.href='Mypage_hospital_update.php'">업데이트</button>


<h2> 나의 치료정보</h2>
<!-- 치료정보 테이블에서 치료 종류 뽑아오기 
'치료종류' 테이블에서 치료시작날짜, 끝날짜, 치료기간 뽑아오기
환자 id로 수술정보  -->
<table >
<?php 
    $sql_treat = "SELECT * FROM treatment_info WHERE patient_id='".$_SESSION['user_id']."'";
    $result_treat = mysqli_query($conn, $sql_treat);
    $c_therapy= null;
    $h_therapy=null;
    $r_therapy=null;
    while ($array_treat = mysqli_fetch_array($result_treat, MYSQLI_ASSOC)){
    $c_therapy = $array_treat['chemotherapy'];
    $h_therapy = $array_treat['hormone_therapy'];
    $r_therapy = $array_treat['radio_therapy'];
    }

    echo"<h3> Chemotherapy</h3>";
    if($c_therapy == 'Yes'){
        $sql_c = "SELECT * FROM chemotherapy WHERE patient_id='".$_SESSION['user_id']."'";
        $result_c = mysqli_query($conn, $sql_c);
        while($row = mysqli_fetch_array($result_c, MYSQLI_ASSOC)){
            echo "{$row['date']}";
        }
    }

    echo"<h3> Hormone Therapy</h3>";
    if($h_therapy == 'Yes'){
        $sql_c = "SELECT * FROM hormone_therapy WHERE patient_id='".$_SESSION['user_id']."'";
        $result_c = mysqli_query($conn, $sql_c);
        while($row = mysqli_fetch_array($result_c, MYSQLI_ASSOC)){
            echo $row['date'];
        }
    }

    echo"<h3> Radio Therapy</h3>";
    if($r_therapy == 'Yes'){
        $sql_c = "SELECT * FROM radio_therapy WHERE patient_id='".$_SESSION['user_id']."'";
        $result_c = mysqli_query($conn, $sql_c);
        while($row = mysqli_fetch_array($result_c, MYSQLI_ASSOC)){
            echo $row['date'];
        }
    }


?>
</table>
<button type="button" name="update_state" onClick="location.href='Mypage_treat_update.php'">업데이트</button><br>
<button type="button" name="update_state" onClick="location.href='Mainpage.html'">메인페이지</button>

<?php
mysqli_close($conn);
include ('./inc/footer.php');
?>
