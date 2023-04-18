<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

    class Clientes extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
            if (empty($_SESSION['correo'])) {
                header('Location: ' . BASE_URL);
            }
            $data['title'] = 'Tu Perfil';
            $data['verificar'] = $this->model->getVerificar($_SESSION['correo']);
            $this->views->getView('principal', "perfil", $data);
        }
        public function registroDirecto(){
            if(isset($_POST['nombre']) && isset($_POST['clave'])) {
                if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave'])) {
                    $mensaje = array ('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
                } else {
                    $nombre = $_POST['nombre'];
                    $correo = $_POST['correo'];
                    $cont = $_POST['clave'];
                    $verificar = $this->model->getVerificar($correo);
                    if (empty($verificar)) {
                        $token = md5($correo);
                        $hash = password_hash($cont, PASSWORD_DEFAULT);
                        $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                        if ($data > 0) {
                            $_SESSION['correo'] = $correo;
                            $_SESSION['nombre'] = $nombre;
                            $mensaje = array ('msg' => 'registrado con éxito', 'icono' => 'success', 'token' => $token);
                        }else {
                            $mensaje = array ('msg' => 'error al registrarse', 'icono' => 'error');
                        }
                    } else {
                        $mensaje = array ('msg' => 'YA TIENES UNA CUENTA', 'icono' => 'warning');
                    }
                }
                echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        public function enviarCorreo(){
            if (isset($_POST['correo']) && isset($_POST['token'])) {
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = USER_SMTP;                     //SMTP username
                    $mail->Password   = PASS_SMTP;                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('tiendavirtmdb@gmail.com', TITLE);
                    $mail->addAddress($_POST['correo']);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Mensaje desde la: ' . TITLE;
                    $mail->Body    = 'Para Verificar tu correo electronico en nuestra tienda <a href="'.BASE_URL.'/clientes/verificarCorreo/'.$_POST['token'].'">CLICK AQUI</a>';
                    $mail->AltBody = 'GRACIAS POR LA PREFERENCIA';

                    $mail->send();
                    $mensaje = array ('msg' => 'CORREO ENVIADO, REVISA TU BANDEJA DE ENTRADA - SPAM', 'icono' => 'success');
                } catch (Exception $e) {
                    $mensaje = array ('msg' => 'ERROR AL ENVIAR EL CORREO: '. $mail->ErrorInfo, 'icono' => 'error');
                }
            } else {
                $mensaje = array ('msg' => 'ERROR FATAL', 'icono' => 'error');
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();       
        }
        function verificarCorreo($token){
            $verificar =$this->model->getToken($token);
            if (!empty($verificar)) {
                $data = $this->model->actualizarVerify($verificar['id']);
                header('Location: ' . BASE_URL . 'clientes');
            }
        }
        
    }
?>