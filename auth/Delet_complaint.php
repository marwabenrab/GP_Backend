<?php
// تضمين ملف الاتصال بقاعدة البيانات
include "../connect.php";

// التحقق من وجود معرف المزارع الذي سيتم حذفه
if (isset($_POST['id_complaint'])) {
    $id_complaint = $_POST['id_complaint'];

    // إعداد استعلام الحذف
    $sql = "DELETE FROM complaint WHERE id_complaint = ?";

    // إعداد البيان
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // ربط المعاملات
        $stmt->bind_param("i", $id_complaint);

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






