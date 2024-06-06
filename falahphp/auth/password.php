<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

class MailServerService {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = "benrabahmarwa099@gmail.com"; // Use your email
        $this->mailer->Password = "tkoggeizwfarchht"; // Use your email password
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Port = 465;
    }

    public function sendMail($to, $subject, $body) {
        try {
            $this->mailer->setFrom("benrabahmarwa099@gmail.com", 'Mailer');
            $this->mailer->addAddress($to);
            $this->mailer->isHTML(false);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
            return "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}

// Example usage:
//$mailService = new MailServerService();
//$mailService->sendMail('recipient@example.com', 'Test Subject', 'Test Body');
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استخراج البريد الإلكتروني من الطلب
    $email = $_POST['email'];

    // التحقق مما إذا كان البريد الإلكتروني صالحًا
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('success' => false, 'message' => 'Invalid email address'));
        exit;
    }

    // إنشاء رمز تحقق عشوائي
    $verificationCode = mt_rand(10000, 99999);

    // ارسال الرمز التحقق إلى البريد الإلكتروني
    $subject = 'رمز التحقق';
    $message = 'رمز التحقق الخاص بك هو: ' . $verificationCode;
    $headers = 'From: example@example.com' . "\r\n" .
                'Reply-To: example@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    // إرسال البريد الإلكتروني
    //$mailSent = mail($email, $subject, $message, $headers);
    $mailService = new MailServerService();
    $mailSent=$mailService->sendMail($email, $subject, $message);
    // التحقق مما إذا كان البريد الإلكتروني قد تم إرساله بنجاح
    if ($mailSent==true) {
        // إرسال رمز التحقق بنجاح
        echo json_encode(array('success' => true, 'verification_code' => $verificationCode));
    } else {
        // فشل في إرسال رمز التحقق
        echo json_encode(array('success' => false, 'message' => 'Failed to send verification code'));
    }
} 
else if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    include "../connect.php";
    parse_str(file_get_contents("php://input"), $_PUT);
    if( isset($_PUT['email']) && isset($_PUT['password']))
{
    
$email = $_PUT['email'];
$password = $_PUT['password'];
$sql = "UPDATE farmer SET password='$password' WHERE email = '$email'";
$result = $con->query($sql);
echo json_encode(array('success' => true, 'data' => $result));
// if($result->num_rows>0){
//     echo json_encode(array('success' => true, 'password' => $password));
// }

}
}

else {
    // الطلب ليس من نوع POST
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}

?>
