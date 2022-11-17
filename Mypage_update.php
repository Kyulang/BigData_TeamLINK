<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

if (isset($_POST['submitted'])){


    $sql= "UPDATE patient_info SET age=?, race=?, marital_status=?, height=?, weight=?, region=? WHERE user_id='".$_SESSION['user_id']."'";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("issdds", $age, $race, $marital_status, $height, $weight, $region);
        $age = $_REQUEST['u_age'];
        $race = $_REQUEST['u_race'];
        $marital_status = $_REQUEST['u_marry'];
        $height= $_REQUEST['u_height'];
        $weight = $_REQUEST['u_weight'];
        $region = $_REQUEST['u_region'];
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


<form action="./Mypage_update.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > age </td>
                <td> <input type="number" name="u_age" size="3"></td>
            </tr>
 
            <tr>
                <td> race</td>
                <td>  <select name="u_race">
                        <option value="Yellow"> Yellow
                        <option value="Black"> Black
                        <option value="White"> White
                    </select></td>
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
                <td  >  <select name="u_marry">
                        <option value="Single"> Single
                        <option value="Married"> Married
                        <option value="Divorced"> Divorced
                    </select></td>
            </tr>
            <tr>
                <td  > region </td>
                <td  >  <select name="u_region">
                <option value="서울특별시"> 서울특별시
                <option value="부산광역시"> 부산광역시
                <option value="대구광역시"> 대구광역시
                <option value="인천광역시"> 인천광역시
                <option value="광주광역시"> 광주광역시
                <option value="대전광역시"> 대전광역시
                <option value="울산광역시"> 울산광역시
                <option value="세종특별자치시"> 세종특별자치시
                <option value="경기도"> 경기도
                <option value="강원도"> 강원도
                <option value="충청북도"> 충청북도
                <option value="충청남도"> 충청남도
                <option value="전라북도"> 전라북도
                <option value="전라남도"> 전라남도
                <option value="경상북도"> 경상북도
                <option value="경상남도"> 경상남도
                <option value="제주특별자치도"> 제주특별자치도
                <option value="기타"> 기타

                    </select></td>
            </tr>
        
    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="업데이트"><BR>
    <input type="hidden" name="submitted" value="TRUE" />
</form>
<?php include ('./inc/footer.php');
?>