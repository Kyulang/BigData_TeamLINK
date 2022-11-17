<?php
header("Content-Type: text/html; charset=UTF-8");

// html header;
$page_title = 'Update MyPage';
include('./inc/header.php');
include "./inc/dbcon.php";

if (isset($_POST['submitted_add_s']) && $_SESSION['user_id'] == 'admin'){
    $sql= "INSERT INTO patient_surgery(id, surgery_type) VALUES(?, ?)";

    echo "<script>
    console.log('PHP_Console:".$_SESSION['user_id']."');
    </script>";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt->bind_param("ss", $id, $surgery_type);
        $id = $_REQUEST['add_s_id'];
        $surgery_type = $_REQUEST['add_s_type'];
        if (mysqli_stmt_execute($stmt)){
            
            echo "<script>
            alert(\"정보가 수정되었습니다.\");
            document.location.href='Add_surgery.php';
            </script>";
            mysqli_close($conn);
        }
    }
}
if (isset($_POST['submitted_d_s']) && $_SESSION['user_id'] == 'admin'&&sizeof($_REQUEST['d_check'])!=""){
    $delete_sql = "DELETE from patient_surgery WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $delete_sql)){
        $stmt->bind_param("s", $id);
        for ($i = 0; $i <sizeof($_REQUEST['d_check']); $i++){
            $id = $_REQUEST['d_check'][$i];
            if (mysqli_stmt_execute($stmt)){
                echo"<script>
                alert(\"정보가 수정되었습니다.\");
                document.location.href='Add_surgery.php';
                </script>";
                mysqli_close($conn);
            }
        }
    }
}
?>


<h1> 수술 추가</h1>
<form action="./Add_surgery.php" method="post">
<table width="100%" name="u_update" align="left">
    <table>
            <tr>
                <td > id </td>
                <td> <input type="text" name="add_s_id" size="30"></td>
            </tr>
            <tr>
                <td  > surgery type </td>
                <td  >  <select name="add_s_type">
                    <?php
                        $list_s = "SELECT surgery FROM surgery_info";
                        $list_s = mysqli_query($conn, $list_s);
                        while($row = mysqli_fetch_array($list_s, MYSQLI_ASSOC)){
                            echo"<option value=\"{$row['surgery']}\">{$row['surgery']}";
                        }
                    ?>
                    </select></td>
            </tr>
        
    </table><br>
    <INPUT TYPE="SUBMIT" VALUE="추가"><BR>
    <input type="hidden" name="submitted_add_s" value="TRUE" /><br>
    <button type="button" name="update_state" onClick="location.href='Mainpage_admin.html'">메인페이지</button> <br>
</form>
<hr color="black"/><br>


<form action="./Add_surgery.php" method="post">
<table border = 1>
<tr><td>check<td></td><td>병원명</td>
<?php
    $list_sql = "SELECT * FROM patient_surgery";
    $list_result = mysqli_query($conn, $list_sql);
    
    while($row = mysqli_fetch_array($list_result, MYSQLI_ASSOC)){
        echo "<tr>
        <td> <input type=\"checkbox\" name=\"d_check[]\" value={$row['id']}></td> 
        <td> {$row['id']} </td>
        <td>{$row['surgery_type']}</td>
        </tr>";
    }
?>
</table>
        <input type="submit" value="삭제">
        <input type="hidden" name="submitted_d_s" value="TRUE"/>
    </form>
 <?php   
    include ('./inc/footer.php');
?>