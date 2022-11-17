<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

$org_sql = "SELECT * FROM cancer_info WHERE patient_id ='".$_SESSION['user_id']."'";
$org_result = mysqli_query($conn, $org_sql);

$org_array = mysqli_fetch_array($org_result, MYSQLI_ASSOC);

if (isset($_POST['submitted'])){


    $sql= "UPDATE cancer_info SET tumor_stage=?, tumor_size=?, relapse_free_status=?, relapse_free_months=?, vital_status=? WHERE patient_id='".$_SESSION['user_id']."'";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("sisds", $tumor_stage, $tumor_size, $relapse_free_status, $relapse_free_months, $vital_status);
        $tumor_stage = $_REQUEST['u_t_stage'];
        $tumor_size = $_REQUEST['u_t_size'];
        $relapse_free_status= $_REQUEST['u_t_free'];
        $relapse_free_months = $_REQUEST['u_t_free_m'];
        $vital_status = $_REQUEST['u_t_vital'];
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


<form action="./Mypage_cancer_update.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > 암 기수 </td>
                <td> 
                <select name="u_t_stage">
                    <option value="I" <?php if($org_array['tumor_stage'] == "I") echo "SELECTED";?>> I
                    <option value="II" <?php if($org_array['tumor_stage'] == "II") echo "SELECTED";?>> II
                    <option value="III" <?php if($org_array['tumor_stage'] == "III") echo "SELECTED";?>> III
                </select>   
                </td>
            </tr>
            <tr>
                <td  > 암 크기 </td>
                <td  >  <input type="number"  name="u_t_size" size="10" value="<?php echo $org_array['tumor_size'];?>"></td>
            </tr>
            <tr>
                <td  > 재발여부 </td>
                <td  > <select name="u_t_free">
                    <option value="Not Recurred" <?php if($org_array['relapse_free_status'] == "Not Recurred") echo "SELECTED";?>> Not Recurred
                    <option value="Recurred" <?php if($org_array['relapse_free_status'] == "Recurred") echo "SELECTED";?>> Recurred
                </select> </td>
            </tr>
            <tr>
                <td  > 비재발기간 </td>
                <td  > <input type="number" step="0.01" name="u_t_free_m" size="10" value="<?php echo $org_array['relapse_free_months'];?>"> </td>
            </tr>
            <tr>
                <td  > 생존여부 </td>
                <td  > <select name="u_t_vital">
                    <option value="Living" <?php if($org_array['vital_status'] == "Living") echo "SELECTED";?>> Living
                    <option value="Died of Other Causes" <?php if($org_array['vital_status'] == "Died of Other Causes") echo "SELECTED";?>> Died of Other Causes
                </select>  </td>
            </tr>
    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="업데이트"><BR>
    <input type="hidden" name="submitted" value="TRUE" />
</form>
<?php include ('./inc/footer.php');
?>