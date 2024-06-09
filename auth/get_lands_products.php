
<?php
include "../connect.php";
if(isset($_POST['id'])){
    $id=$_POST['id'];
    $sql = "SELECT * FROM product WHERE id_Land ='$id'"; $result = $con->query($sql);
    if ($result->num_rows > 0) 
    { $rows = $result->fetch_all(MYSQLI_ASSOC); echo json_encode($rows); } 
    else { echo "[]"; }
}
else { echo "[]"; }


?>