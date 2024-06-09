
<?php
include "../connect.php";

$sql = "SELECT * FROM complaint"; $result = $con->query($sql);
    if ($result->num_rows > 0) 
    { $rows = $result->fetch_all(MYSQLI_ASSOC); echo json_encode($rows); } 
    else { echo "no results found"; }


?>