<?php
// تضمين ملف الاتصال بقاعدة البيانات
include "../connect.php";

// التحقق من وجود معرف المزارع الذي سيتم حذفه
if (isset($_POST['id_Product'])) {
    $id_Product = $_POST['id_Product'];

    // إعداد استعلام الحذف
    $sql = "DELETE FROM product WHERE id_Product = ?";

    // إعداد البيان
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // ربط المعاملات
        $stmt->bind_param("i", $id_Product);

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



