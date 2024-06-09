<?php
// استيراد ملف الاتصال بقاعدة البيانات
require_once 'connect.php';

// تحقق من إرسال بيانات من النموذج
if(isset($_POST['user_id'])) {
    // استدعاء دالة للتحقق من وجود المستخدم في قاعدة البيانات
    $user_id = $_POST['user_id'];
    if(checkUserExists($user_id)) {
        // إرسال المستخدم للتطبيق العادي
        header("Location: normal_app.php");
        exit();
    } else {
        // إرسال المستخدم لصفحة تسجيل الدخول
        header("Location: login.php");
        exit();
    }
}

// دالة للتحقق من وجود المستخدم في قاعدة البيانات
function checkUserExists($user_id) {
    // اتصال بقاعدة البيانات
    $conn = connectDB();

    // استعلام للتحقق من وجود المستخدم
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    // إغلاق اتصال قاعدة البيانات
    mysqli_close($conn);

    // إرجاع قيمة بولية تحدد وجود المستخدم أم لا
    return mysqli_num_rows($result) > 0;
}
?>
