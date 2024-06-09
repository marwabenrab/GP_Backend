
<?php
include "../connect.php";
if( isset($_POST['email']) && isset($_POST['password']))
{
    
$email = $_POST['email'];
$password = $_POST['password'];
/*
// تحقق من وجود اسم المستخدم أو البريد الإلكتروني في قاعدة البيانات
$check_query = "SELECT * FROM farmer WHERE email = ? and password = ?";
$stmt = $con->prepare($check_query);
$stmt->bindParam("ss", (String)$email, (String)$password);
$stmt->execute();
$stmt->bind_result($email_count);
$stmt->fetch();//fecth
$stmt->close();
     */     

$sql = "SELECT * FROM farmer WHERE email = '$email' and password = '$password' ";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    
    $data = array(
        'status' => 'success',
        'user_type'=> $row['user_type'], 
        'id_Farmer' => $row['id_Farmer'],
        'user_name'=>$row['user_name'],
        'phone'=>$row['phone'],
        'email'=>$row['email']
    );
    echo json_encode($data);
}  else {
    
    $data = array('status' => 'Error: No Account found');
    echo json_encode($data);
}
/*else {
    // إضافة المستخدم إذا لم يكن موجودا
    $insert_query = "INSERT INTO farmer (user_name, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($insert_query);
    $stmt->bind_param("sss", $user_name, $email, $password);
    $stmt->execute();
    $stmt->close();
}*/
}else {
    $data = array('status' => 'Error: Missing Data');
    echo json_encode($data);
}
?>




