<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

if (isset($_POST['submitted_add_t']) && $_SESSION['user_id'] == 'admin'){


    $sql= "INSERT INTO therapy(hospital, therapy) VALUES(?, ?)";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("ss", $therapy, $hospital);
        $hospital = $_REQUEST['add_t_name'];
        $region = $_REQUEST['add_t_hospital'];
        if (mysqli_stmt_execute($stmt)){
            
            echo "<script>
            alert(\"정보가 수정되었습니다.\");
            document.location.href='Add_therapy.php';
            </script>";
            mysqli_close($conn);
        }
    }
}
if (isset($_POST['submitted_d_t']) && $_SESSION['user_id'] == 'admin'&&sizeof($_REQUEST['d_check'])!=""){
    $delete_sql = "DELETE from therapy WHERE therapy = ?";
    if($stmt = mysqli_prepare($conn, $delete_sql)){
        $stmt->bind_param("s", $therapy);
        for ($i = 0; $i <sizeof($_REQUEST['d_check']); $i++){
            $therapy = $_REQUEST['d_check'][$i];
            if (mysqli_stmt_execute($stmt)){
                echo"<script>
                alert(\"정보가 수정되었습니다.\");
                document.location.href='Add_therapy.php';
                </script>";
                mysqli_close($conn);
            }
        }
    }
}
?>

<h1> 치료법 추가</h1>
<form action="./Add_therapy.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > 치료법 </td>
                <td> <input type="text" name="add_t_name" size="30"></td>
            </tr>
            <tr>
                <td  > 시행 병원 </td>
                <td  >  <select name="add_t_hospital">
                <?php
                        $list_h = "SELECT hospital FROM hospital_info";
                        $list_h = mysqli_query($conn, $list_h);
                        while($row = mysqli_fetch_array($list_h, MYSQLI_ASSOC)){
                            echo"<option value=\"{$row['hospital']}\">{$row['hospital']}";
                        }
                    ?>
                    </select></td>
            </tr>
        
    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="추가"><BR>
    <input type="hidden" name="submitted_add_t" value="TRUE" /><br>
    <button type="button" name="update_state" onClick="location.href='Mainpage_admin.html'">메인페이지</button> <br>
</form>
<hr color="black"/><br>
<form action="./Add_therapy.php" method="post">
<table border = 1>
<tr>check<td></td><td>치료법</td><td>병원</td>
<?php
    $list_sql = "SELECT * FROM therapy";
    $list_result = mysqli_query($conn, $list_sql);
    
    while($row = mysqli_fetch_array($list_result, MYSQLI_ASSOC)){
        echo "<tr>
        <td> <input type=\"checkbox\" name=\"d_check[]\" value={$row['therapy']}></td> 
        <td> {$row['therapy']} </td>
        <td>{$row['hospital']}</td>
        </tr>";
    }
?>
</table>
        <input type="submit" value="삭제">
        <input type="hidden" name="submitted_d_t" value="TRUE"/>
    </form>
 <?php   
    include ('./inc/footer.php');
?>
