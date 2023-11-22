<?php

/**
 * Hàm có tác dụng kiểm tra tính hợp lệ của tài khoản và gửi mã xác nhận về gmail người dùng
 * data: Dữ liệu nhận về từ client
 */
function CreateAccount_CreateAccount($data)
{
    extract($data);
    $message = "1";
    // tiến hành validate
    if (validateAll(null, $name) === true) {
        if ($gender == 0 || $gender == 1 || $gender == 2) {
            if (validateAll(null, $address) === true) {
                if (validateAll('email', $email) === true) {
                    if (validateAll("password", $password) === true) {
                        if ($password === $confirmPassword) {
                            // kiểm tra gmail có tồn tại hay không
                            $sqlCheckEmail = "select Gmail  from account where Gmail = '$email'";
                            if (!query_One($sqlCheckEmail)) {
                                // tạo mã random để làm mã xác nhận gửi về cho người dùng
                                $randomString = generateRandomString();

                                // tiến hành gửi gmail về cho người dùng
                                $titleGamil = "Xác Nhận Tài Khoản";
                                $contentGmail = "Chào $name!<br/> Chúng tôi đã nhận được yêu cầu đăng ký tài khoản của bạn. Dưới đây là mã xác nhận tạo tài khoản. Mã có giá trị trong 3 phút:
                                <h3 style='color: red'> $randomString</h3>";
                                $jsonData = json_encode($data);

                                if (SendGmailConfirmation($email, $name, $titleGamil, $contentGmail) === true) {
                                    // Tiến hành lưu dữ liệu vào cookie để đến bước xác nhận tài khoản bằng gmail
                                    // chuyển từ mảng thành json
                                    $jsonData = json_encode($data);
                                    setcookie('newAccount', $jsonData, time() + 180, "/");
                                    $_SESSION['code_SendGamilSuccess'] = $randomString;
                                    $message = "";
                                } else {
                                    $message = "500 Hệ thống đang bảo trì";
                                }
                            } else {
                                $message = "Email đã được sử dụng";
                            }
                        } else {
                            $message = "Nhập lại mật khẩu không hợp lệ";
                        }
                    } else {
                        $message = validateAll("password", $password);
                    }
                } else {
                    $message = validateAll('email', $email);
                }
            } else {
                $message = validateAll(null, $address);
            }
        } else {
            $message = validateAll(null, $gender);
        }
    } else {
        $message = validateAll(null, $name);
    }
    return $message;
}


/**
 * Hàm có tác dụng tạo tài khoản trên DB
 * $data: Mã xác nhận được lấy từ client
 */

function CreateAccount_CreateAccount1($data)
{
    $date = date("d/m/Y H:i:s");
    extract($data);
    $message = "";
    $code_SendGamilSuccess = $_SESSION['code_SendGamilSuccess'];
    // lấy dữ liệu từ cookie và chuyển nó thành mảng
    if (isset($_COOKIE['newAccount']) && !empty($_COOKIE['newAccount'])) {
        $dataUser = json_decode($_COOKIE['newAccount'], true);
        extract($dataUser);
        if ($confirmCodeGmail === $code_SendGamilSuccess) {

            $sql = "insert into account values(null, '$name', '$email',  '$gender' ,'$password', null,0,'1', '$date' )";
            if (pdo_Execute($sql) === null) {
                $message = "Tạo tài khoản thành công";
            } else {
                $message = "505 Hệ thống đang bảo trì";
            }
        } else {
            $message = "Mã xác nhận không đúng";
        }
    } else {
        $message = "Mã xác nhận đã hết hạn";
    }
    return $message;
}
