

<?php
include "../connect.php";

//
if (isset($_POST['idFrmer'])) {
        $sql = "SELECT * FROM `ownership` o 
        RIGHT JOIN `land` l ON l.id_Land = o.id_Land
        WHERE o.id_Frmer = '".$_POST['idFrmer']."'";
    } else {
        $sql = "SELECT * FROM land";
    }

$result = $con->query($sql);
    if ($result->num_rows > 0) 
    { $rows = $result->fetch_all(MYSQLI_ASSOC); echo json_encode($rows); } 
    else { echo "no results found"; }


?>