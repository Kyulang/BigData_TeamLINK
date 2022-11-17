<?php
header("Content-Type: text/html; charset=UTF-8");

$page_title = 'MyPage';
include('./inc/header.php');

include "./inc/dbcon.php";

$sql = "SELECT * FROM patient_info WHERE user_id='".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $sql);

echo"<h1> My Page </h1>";
echo "<table border = 1>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo "<tr><td> NAME </td><td>{$row['user_id']}</td></tr>";
    echo "<tr><td> AGE </td> <td>{$row['age']}</td></tr>";
    echo "<tr><td> race </td> <td>{$row['race']}</td></tr>";
    echo "<tr><td> Marriage </td> <td>{$row['marital_status']}</td></tr>";
    echo "<tr><td> height </td> <td>{$row['height']}</td></tr>";
    echo "<tr><td> weight </td> <td>{$row['weight']}</td></tr>";
    echo "<tr><td> region </td> <td>{$row['region']}</td></tr>";
}
echo "</table>";
?>
<button type="button" name="update_state" onClick="location.href='Mypage_update.php'">업데이트</button>
<button type="button" name="update_state" onClick="location.href='Mainpage.html'">메인페이지</button>

<?php
mysqli_close($conn);
include ('./inc/footer.php');
?>
