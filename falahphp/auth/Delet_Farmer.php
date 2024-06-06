<?php
// تضمين ملف الاتصال بقاعدة البيانات
include "../connect.php";

// التحقق من وجود معرف المزارع الذي سيتم حذفه
if (isset($_POST['id_Farmer'])) {
    $id_Farmer = $_POST['id_Farmer'];

    // إعداد استعلام الحذف
    $sql = "DELETE FROM farmer WHERE id_Farmer = ?";

    // إعداد البيان
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // ربط المعاملات
        $stmt->bind_param("i", $id_Farmer);

        // تنفيذ البيان
        if ($stmt->execute()) {
            echo json_encode(["message" => "Record deleted successfully"]);
        } else {
            echo json_encode(["error" => "Error deleting record: " . $stmt->error]);
        }

        // إغلاق البيان
        $stmt->close();
    } else {
        echo json_encode(["error" => "Error preparing statement: " . $con->error]);
    }
} else {
    echo json_encode(["error" => "No farmer ID provided"]);
}

// إغلاق الاتصال
$con->close();
?>






