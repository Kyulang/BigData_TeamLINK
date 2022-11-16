<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

if (isset($_POST['submitted'])){


    $sql= "UPDATE patient_info SET age=?, race=?, marital_status=?, height=?, weight=? WHERE user_id='".$_SESSION['user_id']."'";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("issdd", $age, $race, $marital_status, $height, $weight);
        $age = $_REQUEST['u_age'];
        $race = $_REQUEST['u_race'];
        $marital_status = $_REQUEST['u_marry'];
        $height= $_REQUEST['u_height'];
        $weight = $_REQUEST['u_weight'];
        if (mysqli_stmt_execute($stmt)){
            echo "<script>document.location.href='Mypage.php';</script>";
        }
    }
}
?>


<form action="./Mypage_update.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > age </td>
                <td> <input type="number" name="u_age" size="3"></td>
            </tr>
            <!-- <tr>
                <td  > Sex </td>
                <td  >
                    <select name="u_sex">
                        <option value="male"> male
                        <option value="female"> female
                    </select>
                </td>
            </tr> -->
            <tr>
                <td> race</td>
                <td> <input type="text" name="u_race"></td>
            </tr>
            <tr>
                <td  > height </td>
                <td  > <input type="number" step="0.01"  name="u_height" size="10"> </td>
            </tr>
            <tr>
                <td  > weight </td>
                <td  > <input type="number" step="0.01" name="u_weight" size="10"> </td>
            </tr>
            <tr>
                <td  > marry </td>
                <td  > <input type="text" name="u_marry" size="3"> </td>
            </tr>
            <tr>
                <td  > cancer stage </td>
                <td  > <input type="number" name="u_cstage_up" size="1"> </td>
            </tr>
            <tr>
                <td  > hospital </td>
                <td  > <input type="text" size="30" name="u_hospital_up"></td>
            </tr>
        
    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="업데이트"><BR>
    <input type="hidden" name="submitted" value="TRUE" />
</form>
<?php include ('./inc/footer.php');
?>