<?php
header("Content-Type: text/html; charset=UTF-8");

$page_title = '병원별 통계';
include('./inc/header.php');

include "./inc/dbcon.php";
?>
<h1>병원별 통계 </h1>
<h3>1기 암환자가 가장 많이 다니는 곳</h3>
    <table border="3">
        <th>병원명</th>
        <th>환자수</th>
<?php
    $sql = "SELECT a.hospital, count(*)AS mycount FROM hospital_info AS a INNER JOIN cancer_info AS b ON a.patient_id = b.patient_id WHERE b.tumor_stage='I' AND b.vital_status='Living' GROUP BY a.hospital ORDER by count(*) desc";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        if($row['hospital']!="")
            echo"<tr><td>{$row['hospital']}</td><td>{$row['mycount']}</td></tr>";
    }
?>
    </table>
    <br>
    <h3>2기 암환자가 가장 많이 다니는 곳</h3>
    <table border="3">
        <th>병원명</th>
        <th>환자수</th>
<?php
    $sql = "SELECT a.hospital, count(*)AS mycount FROM hospital_info AS a INNER JOIN cancer_info AS b ON a.patient_id = b.patient_id WHERE b.tumor_stage='II' AND b.vital_status='Living' GROUP BY a.hospital ORDER by count(*) desc";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        if($row['hospital']!="")
            echo"<tr><td>{$row['hospital']}</td><td>{$row['mycount']}</td></tr>";
    }
?>

    </table>
    <br>

    <h3>3기 암환자가 가장 많이 다니는 곳</h3>
    <table border="3">
        <th>병원명</th>
        <th>환자수</th>
<?php
    $sql = "SELECT a.hospital, count(*)AS mycount FROM hospital_info AS a INNER JOIN cancer_info AS b ON a.patient_id = b.patient_id WHERE b.tumor_stage='III' AND b.vital_status='Living' GROUP BY a.hospital ORDER by count(*) desc";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        if($row['hospital']!="")
            echo"<tr><td>{$row['hospital']}</td><td>{$row['mycount']}</td></tr>";
    }
?>

    </table>
    <br>
    <button type="button" name="update_state" onClick="location.href='./Stat_Main.html'">통계보기</button><br>
    <button type="button" name="update_state" onClick="location.href='Mainpage.html'">메인페이지</button>    
<?php
mysqli_close($conn);
include ('./inc/footer.php');
?>
