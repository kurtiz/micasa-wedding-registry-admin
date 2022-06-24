<?php


    namespace App\Controllers;
    use App\Models\LoginModel;
    use CodeIgniter\Controller;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';




    class ForgotPassword extends Controller {

        public $loginModel;

        public function __construct() {
            helper(["form", "Uuid"]);
            $this->loginModel = new LoginModel();
        }

        public function index() {
            $data =[];
            if ($this->request->getMethod() == "post") {
                $username = $this->request->getVar('username');

                $details =$this->loginModel->verifyUsername($username);
                if($details){
                    $clause = [
                        'uniid' => uuid4(),
                        'activation_date' => date("Y-m-d H:i:s")
                        ];
                    $message = view("password_reset_email");
                    $message = str_replace("{user}", $details['name'], $message);
                    $message = str_replace("{uniid}", $clause['uniid'], $message);
                    $message = str_replace("{username}", $username, $message);

                    $this->loginModel->setUuid($username, $clause);

                    //Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'mail.ourtechonologies.com';            //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'info@ourtechonologies.com';                     //SMTP username
                        $mail->Password   = 'otcadmin2020';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                        //Recipients
                        $mail->setFrom('noreply@ourpos.com', 'OurPos');
                        $mail->addAddress('papiliocurtis@gmail.com');     //Add a recipient

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Here is the subject';
                        $mail->Body    = $message;
                        $mail->AltBody = 'Hi {user},\nForgot your password..? Don\'t worry lets get you a new one use the link below \n ' .
                            base_url()."/passwordreset/".$username."/".$clause['uniid'];

                        $mail->send();
                        echo 'Message has been sent';
                        exit;
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        exit;
                    }
                }else{
                    echo "username error";
                }



            }
            return view("forgot_password",$data);
        }

    }