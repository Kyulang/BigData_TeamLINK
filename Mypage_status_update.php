<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

$org_sql = "SELECT * FROM bio_info WHERE patient_id ='".$_SESSION['user_id']."'";
$org_result = mysqli_query($conn, $org_sql);

$org_array = mysqli_fetch_array($org_result, MYSQLI_ASSOC);

if (isset($_POST['submitted'])){


    $sql= "UPDATE bio_info SET age=?, marital_status=?, height=?, weight=? WHERE patient_id='".$_SESSION['user_id']."'";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("isdd", $age, $marital_status, $height, $weight);
        $age = $_REQUEST['u_age'];
        $marital_status = $_REQUEST['u_marry'];
        $height= $_REQUEST['u_height'];
        $weight = $_REQUEST['u_weight'];
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


<form action="./Mypage_status_update.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > age </td>
                <td> <input type="number" name="u_age" size="3" value="<?php echo $org_array['age'];?>"></td>
            </tr>
            <tr>
                <td  > marry </td>
                <td  >  <select name="u_marry">
                        <option value="Single" <?php if($org_array['marital_status'] == "Single") echo "SELECTED";?>> Single
                        <option value="Married" <?php if($org_array['marital_status'] == "Married") echo "SELECTED";?>> Married
                        <option value="Divorced" <?php if($org_array['marital_status'] == "Divorced") echo "SELECTED";?>> Divorced
                    </select></td>
            </tr>
            <tr>
                <td  > height </td>
                <td  > <input type="number" step="0.01"  name="u_height" size="10" value="<?php echo $org_array['height'];?>"> </td>
            </tr>
            <tr>
                <td  > weight </td>
                <td  > <input type="number" step="0.01" name="u_weight" size="10" value="<?php echo $org_array['weight'];?>"> </td>
            </tr>
    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="업데이트"><BR>
    <input type="hidden" name="submitted" value="TRUE" />
</form>
<?php include ('./inc/footer.php');
?>