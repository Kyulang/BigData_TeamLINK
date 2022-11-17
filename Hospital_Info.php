<?php
header("Content-Type: text/html; charset=UTF-8");

$page_title = '병원 정보';
include('./inc/header.php');
include "./inc/dbcon.php";
?>

<h1>병원 정보 </h1> 
 의료진 정보<br>
 <table width="100%" name="hospital_info" align="left">
<form name = "doctor_info_form" action="Hospital_Info.php" method="post">
    <table width="100%" name="reservation" align="left">
            <tr>
                <td> 병원 선택 </td>
                <td> <select name="hospital_name"> 병원 선택
                    <?php
                    $list_h = "SELECT hospital FROM hospital";
                    $result = mysqli_query($conn, $list_h);
                    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo"<option value\"{$row['hospital']}\">{$row['hospital']}";
                    }
                    ?>
                    </select>
            </tr>
            <tr>
                <td> 의사 선택 </td>
                <td>
                <select name="doctor_name"> 의사 선택
                    <?php
                        $list_h = "SELECT doctors, area FROM doctors_info";
                        $result = mysqli_query($conn, $list_h);
                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {
                            echo"<option value\"{$row['doctors']}\">{$row['doctors']} ( {$row['area']} )";
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td> 시간 선택 </td>
                <td>
                    <select name="reservation_time"> 시간대 선택
                    <?php
                        $list_h = "SELECT doctors, `time` FROM time_table";
                        $result = mysqli_query($conn, $list_h);
                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {
                            echo"<option value\"{$row['doctors']}\">{$row['doctors']} ( {$row['time']} )";
                        }
                    ?>     
                    </select>
            </tr>   
    <br>
</form>
</table>
<button type="button" name="go_Mainpage" onClick="location.href='Mainpage.html'">메인 페이지로 돌아가기</button><BR>

</body>

</html>

<?php
mysqli_close($conn);
include ('./inc/footer.php');
?>
