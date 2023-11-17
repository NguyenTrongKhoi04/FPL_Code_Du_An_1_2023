<?php 
require "./assets/PHPMailer-master/src/PHPMailer.php";
require "./assets/PHPMailer-master/src/SMTP.php";
require "./assets/PHPMailer-master/src/Exception.php";
/**
 * Hàm có tác dụng gửi gmail , hàm trả về true = thành công, false = thất bại
 * $recipientGmail: gmail của người nhận
 * $nameRecipientGmail: Tên của người nhận,
 * $titleGamil: Tiêu đề thư
 * $contentGmail: Nội dung thư 
 */
use PHPMailer\PHPMailer\PHPMailer;
function SendGmailConfirmation($recipientGmail, $nameRecipientGmail, $titleGamil, $contentGmail){
    $mail = new PHPMailer(true);
    try{
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->CharSet = "utf8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true ;
        $mail->Username = "VuDiep0359@gmail.com";
        $mail->Password = ' dllx epph jetj hndr';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail-> setFrom("VuDiep0359@gmail.com", "HR Terrace Restaurant");
        $mail-> addAddress($recipientGmail,$nameRecipientGmail);
        $mail->isHTML(true);
        $mail->Subject = $titleGamil;
        $content = "<h4>{$contentGmail}</h4>";
        $mail->Body = $content;
        $mail->smtpConnect(
            array(
                'ssl' => array(
                    "verify_peer" =>false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true,
                )
            )
                );
                $mail -> send();
                return true;

    }catch(Exception $e){
        return false;
    }
}

?>