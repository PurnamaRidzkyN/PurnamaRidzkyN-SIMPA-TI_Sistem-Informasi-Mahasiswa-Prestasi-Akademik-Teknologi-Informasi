<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\users\Admin;
use app\models\database\users\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use app\constant\Config;
use PHPMailer\PHPMailer\SMTP;

require_once "vendor/autoload.php";
require_once "helpers/env.php";



class ChangePassword extends BaseController
{
    public function forgotPassword(Request $req, Response $res): void
    {
        $body = $req->body();
        $username = $body["username"];
        $email = $body["email"];
        $gmail = Config::getEmail();

        try {
            // Cari user berdasarkan username atau email
            $user = User::findOne($username)["result"][0];

            if (!$user) {
                $this->view("login/lupa_sandi", "login", ["error" => "User tidak ditemukan"]);
                return;
            }

            switch ($user["role"]) {
                case "1":
                    $admin = Admin::findEmail($email)["result"][0];
                    if (($email == $admin['email']) && ($admin["id_user"] == $user['id'])) {
                        $this->sendPassword($gmail,$user,$admin);
                        $res->redirect("/login");
                    }
                    break;

                case "2":
                    
                    break;
                default:
                    $res->redirect("/");
                    break;
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
        //
    }

    public function renderForgotPassword(): void
    {
        $this->view("login/forgotPassword", "forgot Password");
    }
    private function sendPassword(array $gmail,$user,$role):void{
        $mail = new PHPMailer(true);
        $password = bin2hex(random_bytes(5));
        $hashpassword = password_hash($password , PASSWORD_BCRYPT);
        User::update($hashpassword, "username", $user['username']);
        
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            // email aktif yang sebelumnya di setting
            $mail->Username   = $gmail['email'];
            // password yang sebelumnya di simpan
            $mail->Password   = $gmail['PWD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;


            $mail->setFrom($gmail['email'], 'SIMPA-TI');  // Email dan nama pengirim
            $mail->addAddress('naotomori220405@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'Pemberitahuan Perubahan Password SIMPA-TI';
            $mail->Body    = 'Halo ' . $role['email'] . ', <br><br>Dengan hormat,<br><br>Kami menerima permintaan untuk mereset password akun Anda di website SIMPA-TI . Password Anda telah berhasil diperbarui.<br><br>
                            Berikut adalah informasi terkait penggantian password:<br><br>
                            Username: ' . $role['nip'] . '\n
                            Password Baru: ' . $password . '\n\n
                            Silakan menggunakan password baru tersebut untuk masuk ke website SIMPA-TI. Setelah berhasil login, Anda disarankan untuk segera mengganti password Anda melalui pengaturan akun di dalam website untuk alasan keamanan.<br><br>
                            Harap menjaga kerahasiaan informasi ini dan tidak memberikannya kepada pihak yang tidak berwenang. Jika Anda mengalami kesulitan dalam mengakses sistem atau membutuhkan bantuan lebih lanjut, silakan menghubungi layanan bantuan kami melalui email di megumindesu2204@gmail.com  .\n\n
                            Terima kasih atas perhatian dan kerjasama Anda.\n\n
                            Hormat kami,\nTim SIMPA-TI\nPOLINEMA';
            $mail->send();
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
