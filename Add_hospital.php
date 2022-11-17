<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

if (isset($_POST['submitted_add_h']) && $_SESSION['user_id'] == 'admin'){


    $sql= "INSERT INTO hospital(hospital, region) VALUES(?, ?)";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("ss", $hospital, $region);
        $hospital = $_REQUEST['add_h_name'];
        $region = $_REQUEST['add_h_region'];
        if (mysqli_stmt_execute($stmt)){
            
            echo "<script>
            alert(\"정보가 수정되었습니다.\");
            document.location.href='Add_hospital.php';
            </script>";
            mysqli_close($conn);
        }
    }
}
if (isset($_POST['submitted_d_h']) && $_SESSION['user_id'] == 'admin'&&sizeof($_REQUEST['d_check'])!=""){
    $delete_sql = "DELETE from hospital WHERE hospital = ?";
    if($stmt = mysqli_prepare($conn, $delete_sql)){
        $stmt->bind_param("s", $hospital);
        for ($i = 0; $i <sizeof($_REQUEST['d_check']); $i++){
            $hospital = $_REQUEST['d_check'][$i];
            if (mysqli_stmt_execute($stmt)){
                echo"<script>
                alert(\"정보가 수정되었습니다.\");
                document.location.href='Add_hospital.php';
                </script>";
                mysqli_close($conn);
            }
        }
    }
}
?>

<h1> 병원 추가</h1>
<form action="./Add_hospital.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > 병원 </td>
                <td> <input type="text" name="add_h_name" size="30"></td>
            </tr>
            <tr>
                <td  > region </td>
                <td  >  <select name="add_h_region">
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
    <INPUT TYPE="SUBMIT" VALUE="추가"><BR>
    <input type="hidden" name="submitted_add_h" value="TRUE" /><br>
    <button type="button" name="update_state" onClick="location.href='Mainpage_admin.html'">메인페이지</button> <br>
</form>
<hr color="black"/><br>
<form action="./Add_hospital.php" method="post">
<table border = 1>
<tr>check<td></td><td>병원명</td><td>region</td>
<?php
    $list_sql = "SELECT * FROM hospital";
    $list_result = mysqli_query($conn, $list_sql);
    
    while($row = mysqli_fetch_array($list_result, MYSQLI_ASSOC)){
        echo "<tr>
        <td> <input type=\"checkbox\" name=\"d_check[]\" value={$row['hospital']}></td> 
        <td> {$row['hospital']} </td>
        <td>{$row['region']}</td>
        </tr>";
    }
?>
</table>
        <input type="submit" value="삭제">
        <input type="hidden" name="submitted_d_h" value="TRUE"/>
    </form>
 <?php   
    include ('./inc/footer.php');
?>
