<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

$org_sql = "SELECT * FROM treatment_info WHERE patient_id ='".$_SESSION['user_id']."'";
$org_result = mysqli_query($conn, $org_sql);
$org_array = mysqli_fetch_array($org_result, MYSQLI_ASSOC);

$org_c_sql = "SELECT * FROM chemotherapy WHERE patient_id='".$_SESSION['user_id']."'";
$org_c_result = mysqli_query($conn, $org_c_sql);
$org_c_array = mysqli_fetch_array($org_c_result, MYSQLI_ASSOC);

$org_h_sql = "SELECT * FROM hormone_therapy WHERE patient_id='".$_SESSION['user_id']."'";
$org_h_result = mysqli_query($conn, $org_h_sql);
$org_h_array = mysqli_fetch_array($org_h_result, MYSQLI_ASSOC);

$org_r_sql = "SELECT * FROM radio_therapy WHERE patient_id='".$_SESSION['user_id']."'";
$org_r_result = mysqli_query($conn, $org_r_sql);
$org_r_array = mysqli_fetch_array($org_r_result, MYSQLI_ASSOC);

if (isset($_POST['submitted'])){


    $treat_sql= "UPDATE treatment_info SET chemotherapy=?, hormone_therapy=?, radio_therapy=? WHERE patient_id='".$_SESSION['user_id']."'";
    $treat_c_sql = "UPDATE chemotherapy SET chemotherapy=?, `date`=? WHERE patient_id='".$_SESSION['user_id']."'";
    $treat_h_sql = "UPDATE hormone_therapy SET hormone_therapy=?, `date`=? WHERE patient_id='".$_SESSION['user_id']."'";
    $treat_r_sql = "UPDATE radio_therapy SET radio_therapy=?, `date`=? WHERE patient_id='".$_SESSION['user_id']."'";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $treat_sql)){
        $stmt->bind_param("sss", $chemotherapy, $hormone_therapy, $radio_therapy);
        $chemotherapy = $_REQUEST['c_therapy_bool'];
        $hormone_therapy = $_REQUEST['h_therapy_bool'];
        $radio_therapy= $_REQUEST['r_therapy_bool'];
        $r=mysqli_stmt_execute($stmt);   
    }
    if($stmt1 = mysqli_prepare($conn, $treat_c_sql)){
        $stmt1->bind_param("ss", $chemotherapy, $date);
        $chemotherapy = $_REQUEST['c_therapy_bool'];
        $date=$_REQUEST['c_therapy_date'];
        $r1 = mysqli_stmt_execute($stmt1);
    }
    if($stmt2 = mysqli_prepare($conn, $treat_h_sql)){
        $stmt2->bind_param("ss", $hormone_therapy, $date);
        $hormone_therapy = $_REQUEST['h_therapy_bool'];
        $date=$_REQUEST['h_therapy_date'];
        $r2=mysqli_stmt_execute($stmt2);
    }
    if($stmt3 = mysqli_prepare($conn, $treat_r_sql)){
        $stmt3->bind_param("ss", $radio_therapy, $date);
        $radio_therapy= $_REQUEST['r_therapy_bool'];
        $date=$_REQUEST['r_therapy_date'];
        $r3=mysqli_stmt_execute($stmt3);
    }
        if ($r&&$r1&&$r2&&$r3){
            echo "<script>
            alert(\"정보가 수정되었습니다.\");
            document.location.href='Mypage.php';
            </script>";
            mysqli_close($conn);
        }
}
?>


<form action="./Mypage_treat_update.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > chemotherapy </td>
                <td><select name="c_therapy_bool"> 
                    <option value="No" <?php if($org_array['chemotherapy'] == "No") echo "SELECTED";?>> No
                    <option value="Yes" <?php if($org_array['chemotherapy'] == "Yes") echo "SELECTED";?>> Yes
                </select></td>
                <td> 
                <input type="text" name="c_therapy_date" size="10" value= "<?php echo $org_c_array['date'];?>">
                </td>
            </tr>
            <tr>
                <td > hormone therapy </td>
                <td><select name="h_therapy_bool"> 
                    <option value="No" <?php if($org_array['hormone_therapy'] == "No") echo "SELECTED";?>> No
                    <option value="Yes" <?php if($org_array['hormone_therapy'] == "Yes") echo "SELECTED";?>> Yes
                </select></td>
                <td> 
                <input type="text" name="h_therapy_date" size="10" value= "<?php echo $org_h_array['date'];?>">
                </td>
            </tr>
            <tr>
                <td > radio therapy </td>
                <td><select name="r_therapy_bool"> 
                    <option value="No" <?php if($org_array['radio_therapy'] == "No") echo "SELECTED";?>> No
                    <option value="Yes" <?php if($org_array['radio_therapy'] == "Yes") echo "SELECTED";?>> Yes
                </select></td>
                <td> 
                <input type="text" name="r_therapy_date" size="10" value= "<?php echo $org_r_array['date'];?>">
                </td>
            </tr>
    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="업데이트"><BR>
    <input type="hidden" name="submitted" value="TRUE" />
</form>
<?php include ('./inc/footer.php');
?>