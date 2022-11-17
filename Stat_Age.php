<?php
header("Content-Type: text/html; charset=UTF-8");

$page_title = '병원별 통계';
include('./inc/header.php');

include "./inc/dbcon.php";
?>
<h1>연령별 통계 </h1>
<table border="3">
    <th> 연령대</th>
    <th> tumor size</th>
    <?php
    $sql="SELECT AVG(b.tumor_size)AS avgsize, floor(a.age/10)*10 AS avgage FROM bio_info AS a INNER JOIN cancer_info AS b ON a.patient_id = b.patient_id GROUP BY floor(a.age/10)";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        if($row['avgsize']!="" && $row['avgage']!=""){
            echo"<tr><td>{$row['avgage']}대</td><td>{$row['avgsize']}</td></tr>";
        }
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
