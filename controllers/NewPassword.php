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
use app\helpers\Dump;
use app\models\database\users\Mahasiswa;
use app\models\database\logData\LogData;
use app\helpers\UUID;


require_once "vendor/autoload.php";
require_once "helpers/env.php";



class NewPassword extends BaseController
{
    public function handleForgotPassword(Request $req, Response $res): void
    {
        $body = $req->body();
        Dump::out($body);
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
                        $this->sendPassword($gmail, $user, $admin);
                        $res->redirect("/login");
                    }
                    break;

                case "2":
                    $mahasiswa = Mahasiswa::findEmail($email)["result"][0];
                    if (($email == $mahasiswa['email']) && ($mahasiswa["id_user"] == $user['id'])) {
                        $this->sendPassword($gmail, $user, $mahasiswa);
                        $res->redirect("/login");
                    }
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
    private function sendPassword(array $gmail, $user, $role): void
    {
        try {
            $mail = new PHPMailer(true);
            $password = bin2hex(random_bytes(5));
            $hashpassword = password_hash($password, PASSWORD_BCRYPT);
            User::updatePassword($hashpassword, "username", $user['username']);
            LogData::insert(UUID::generate("log_data","LD"), $user["id"],$user["id"], "user", "update", "[passsword]", "merubah password baru", "null");

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
            $mail->Body    = 'Halo ' . $role['nama'] . ', <br><br>Dengan hormat,<br><br>Kami menerima permintaan untuk mereset password akun Anda di website SIMPA-TI . Password Anda telah berhasil diperbarui.<br><br>
                            Berikut adalah informasi terkait penggantian password:<br><br>
                            <br>Username: ' . $user['username'] . '<br>
                            <br>Password Baru: ' . $password . '<br>
                            Silakan menggunakan password baru tersebut untuk masuk ke website SIMPA-TI. Setelah berhasil login, Anda disarankan untuk segera mengganti password Anda melalui pengaturan akun di dalam website untuk alasan keamanan.<br><br>
                            Harap menjaga kerahasiaan informasi ini dan tidak memberikannya kepada pihak yang tidak berwenang. Jika Anda mengalami kesulitan dalam mengakses sistem atau membutuhkan bantuan lebih lanjut, silakan menghubungi layanan bantuan kami melalui email di megumindesu2204@gmail.com  .<br><br>
                            Terima kasih atas perhatian dan kerjasama Anda.<br><br>
                            Hormat kami,<br><br>Tim SIMPA-TI<br><br>POLINEMA';
            $mail->send();
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
    public function changePassword(Request $req, Response $res)
    {
        $body = $req->body();
        $email = $body["email"];
        $password = $body["old_password"];
        $newPassword = $body["new_password"];
        $username =Session::get("user");
        
        try {
            $user =User::findOne($username)["result"][0];
            Dump::out($user);    
            if (!password_verify($password, $user["password"])) {
                $this->view("login/changePassword", "changePassword", ["error" => "wrong password"]);                
                return;
            }
            switch ($user["role"]) {
                case '1':
                    $admin =Admin::findEmail($email);
                    if($email==($admin["result"][0]["email"])){
                        $hashpassword = password_hash($newPassword, PASSWORD_BCRYPT);
                        User::updatePassword($hashpassword, "username", $user['username']);
                        LogData::insert(UUID::generate("log_data","LD"), $user["id"],$user["id"], "user", "update", "[passsword]", "merubah password baru", "null");
                        $res->redirect("/dashboard/admin/{$user["username"]}");
                        
                    }
                    break;
                case '2':
                    $hashpassword = password_hash($newPassword, PASSWORD_BCRYPT);
                        User::updatePassword($hashpassword, "username", $user['username']);
                        LogData::insert(UUID::generate("log_data","LD"), $user["id"],$user["id"], "user", "update", "[passsword]", "merubah password baru", "null");

                        $res->redirect("/dashboard/mahasiswa/{$user["username"]}");
                default:
                    # code...
                    break;
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
    public function renderChangePassword(): void
    {
        $this->view("login/changePassword", "Change Password");
    }
}
