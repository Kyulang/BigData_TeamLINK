<?php
header("Content-Type: text/html; charset=UTF-8");

$page_title = '치료별 통계';
include('./inc/header.php');

include "./inc/dbcon.php";
?>
<h1>치료별 통계 </h1>

    치료별 통계 <BR>
    치료별 확률  <BR>
        <table border="3">
            <th>치료명</th> <th>받은 사람 수</th>
<?php
    $sql="SELECT count(*) AS c_count FROM treatment_info WHERE chemotherapy='Yes'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo"<tr><td>Chemotherapy</td><td>{$row['c_count']}</td></tr>";
    }
    $sql="SELECT count(*) AS h_count FROM treatment_info WHERE hormone_therapy='Yes'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo"<tr><td>hormone_therapy</td><td>{$row['h_count']}</td></tr>";
    }
    $sql="SELECT count(*) AS r_count FROM treatment_info WHERE radio_therapy='Yes'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo"<tr><td>hormone_therapy</td><td>{$row['r_count']}</td></tr>";
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
