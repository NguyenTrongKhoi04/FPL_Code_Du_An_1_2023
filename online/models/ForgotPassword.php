<?php 
    function ForgotPassword_CheckGmail($gmail){
        $message = "";
        $dataGmail = query_One("select count(*), NameAccount from account where Gmail = '$gmail'");

        if($dataGmail["count(*)"] === 1){
            $message = true;
            $nameRecipientGmail = $dataGmail["NameAccount"];
            $codeRandom = generateRandomString();
            $recipientGmail = $gmail;
            $titleGamil = "Cập Nhập Lại Mật Khẩu";
            $contentGmail = "Xin chào $nameRecipientGmail ! <br/> Chúng tôi đã nhận được yêu cầu cập nhật lại mật khẩu của bạn. Dưới đây là mã xác nhận tạo tài khoản. Mã có giá trị trong 2 phút: <h1> $codeRandom </h1>";
            
            SendGmailConfirmation($recipientGmail, $nameRecipientGmail, $titleGamil, $contentGmail);
            setcookie("codeRandom", $codeRandom, time() + 120, "/");
        }else{
            $message = "Gmail của bạn không tồn tại";

        }
        return $message ;
    }
    function ForgotPassword_VerificationAccount($data, $codeRandom, $oldGmail){
        extract($data);
        $message = "";
        if($codeRandom === $Verification){
            $message = query_One("update account set Password = '$newPassword' where Gmail = '$oldGmail'") === false ? "Cập nhật tài khoản thành công vui lòng đăng nhập tài khoản của bạn !" : "Hệ thống đang bảo trì";
            setcookie("codeRandom", "", time() - 120, "/");

        }else{
            $message = "Mã xác nhận không chính xác...";
        }
        return $message; 
    }
?>