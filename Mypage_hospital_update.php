<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

$org_sql = "SELECT * FROM hospital_info WHERE patient_id ='".$_SESSION['user_id']."'";
$org_result = mysqli_query($conn, $org_sql);

$org_array = mysqli_fetch_array($org_result, MYSQLI_ASSOC);

if (isset($_POST['submitted'])){


    $sql= "UPDATE hospital_info SET hospital=?, rooms=?, admission=?, discharge=? WHERE patient_id='".$_SESSION['user_id']."'";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("siss", $hospital, $rooms, $admission, $discharge);
        $hospital = $_REQUEST['u_h_hos'];
        $rooms = $_REQUEST['u_h_room'];
        $admission= $_REQUEST['u_h_dis'];
        $discharge = $_REQUEST['u_h_dis'];
        if (mysqli_stmt_execute($stmt)){
            
            echo "<script>
            alert(\"정보가 수정되었습니다.\");
            document.location.href='Mypage.php';
            </script>";
            mysqli_close($conn);
        }
    }
}
?>


<form action="./Mypage_hospital_update.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > 병원 이름 </td>
                <td> 
                <select name="u_h_hos">
                <?php
                        $list_h = "SELECT hospital FROM hospital";
                        $result = mysqli_query($conn, $list_h);
                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {
                            echo"<option value\"{$row['hospital']}\">{$row['hospital']}";
                        }
                ?>
                </select>   
                </td>
            </tr>
            <tr>
                <td  >  병동(병실) </td>
                <td  >  <input type="number"  name="u_h_room" size="10" value="<?php echo $org_array['rooms'];?>"></td>
            </tr>
            <tr>
                <td  > 입원날짜 </td>
                <td  > <input type="date" name="u_h_dis" size="10" value="<?php echo $org_array['discharge'];?>"></td>
            </tr>
            <tr>
                <td  > 퇴원날짜 </td>
                <td  > <input type="date" name="u_h_dis" size="10" value="<?php echo $org_array['discharge'];?>"> </td>
            </tr>

    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="업데이트"><BR>
    <input type="hidden" name="submitted" value="TRUE" />
</form>
<?php include ('./inc/footer.php');
?>