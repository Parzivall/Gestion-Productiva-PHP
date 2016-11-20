<?php

    require_once 'Models/UsuarioModel.php';

    class UsuariosController
    {
        private $model;
        //private $fichero = "testlog.txt";

        function __construct()
        {
            $this->model = new Usuario();


        }

        public function Logout(){
            $this->model->Logout();
            header('Location:'.BASE_URL);
        }

        public function Login(){
            //file_put_contents($this->fichero, "Entra a login");
            $Usuario = new Usuario();
            $Usuario->Username = $_REQUEST['Username'];
            $Usuario->Password = $_REQUEST['Password'];            
            //file_put_contents($this->fichero, 'Usuario:'.$Usuario->Username, FILE_APPEND);
            //file_put_contents($this->fichero, 'Contraseña:'.$Usuario->Username, FILE_APPEND);
            if ($this->model->Login($Usuario)){
                header('Location:'.BASE_URL);
            }
            else
            {
                header('Location:'.BASE_URL.'Usuarios/Error');
            }          
        }

        public function Error(){
            if (isset($_SESSION['NoUnidad']) && $_SESSION['NoUnidad']=="1"){
                $error ="El Usuario no tiene asignada una Unidad Productiva para Administrar";
            }
            else{
                $error= "Usuario o Contraseña incorrectos";
            }          
            require_once 'Views/Usuarios/login.php';    
        }

        public function VerificarEmail(){
            require_once 'Views/Usuarios/check_UserEmailExistence.php';
        }

        public function Index(){
            if ($this->model->isLoggedIn())
            {
                header('Location:'.BASE_URL.'Home');
            }
            else
            {
                require_once 'Views/Usuarios/login.php';
            }    
        }
        
        public function Registro(){
            $usuario = new Usuario();
            
            require_once 'Views/Usuarios/registro.php';
        }

        public function ChangePassword()
        {
            $newPassword = $_REQUEST["Password"];
            $username = $_REQUEST["Username"];
            $token = $_REQUEST["Token"];
            if ($this->model->changePassword($username, $newPassword)){
                $this->model->eliminarToken($token);
                header('Location:'.BASE_URL);
            }
            else
            {
                $error = "Un error ocurrio, no se pudo cambiar la contraseña";
                require_once 'Views/Usuarios/login.php';
            }

        }

        public function ResetPassword()
        {
            $Username = '';
            $token = '';
            $error = '';
            try {
                //echo 'Token recibido:'.$token;
                // retrieve token
                if (isset($_REQUEST["Token"]) && preg_match('/^[0-9A-F]{40}$/i', $_REQUEST["Token"])) {
                    $token = $_REQUEST["Token"];
                }
                else {
                    throw new Exception("Enlace válido no proporcionado.");
                }
                
                // verify token
                $row = $this->model->getToken($token);

                if ($row) {
                    extract($row);
                }
                else {
                    throw new Exception("Enlace válido no proporcionado.");
                }

                // 1 day measured in seconds = 60 seconds * 60 minutes * 24 hours
                $delta = 86400;

                // Check to see if link has expired
                if ($_SERVER["REQUEST_TIME"] - $TokenTimestamp > $delta) {
                    throw new Exception("El enlace ha expirado");
                }

                //Hasta este punto, si todo esta bien, entonces mostrar la pagina para cambiar la contraseña.
                // do one-time action here, like activating a user account

                //require_once 'Views/Usuarios/ResetPassword.php';    

                // ...

                // delete token so it can't be used again
                //$this->model->eliminarToken($token);
                
                
            } catch (Exception $e) {
                $error = $e->getMessage();
                //die($e->getMessage());  
            }
            require_once 'Views/Usuarios/ResetPassword.php';    
            
            /*
            $token = sha1(uniqid($username, true));
            $this->model->addToken($username, $token);
            echo "Token agregado", $token;
            */
        }
        
        public function Recuperar(){
            $usuario = new Usuario();
            require_once 'Views/Usuarios/recuperar.php';
        }

        public function Guardar(){
            $usuario = new Usuario();
            
            $usuario->Username = $_REQUEST['Username'];
            $usuario->Password = $_REQUEST['Password'];

            $this->model->Registrar($usuario);
            $usuario->id > 0 
                ? $this->model->Actualizar($alm)
                : $this->model->Registrar($alm);
            header('Location:'.BASE_URL.'Usuarios');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['id']);
            header('Location:'.BASE_URL.'index.php');
        }

        public function enviarLinkRestablecimiento($email, $username ,$token){
            require 'Core/Mail/PHPMailerAutoload.php';
              $mail = new PHPMailer;
              $mail->isSMTP();
              //$mail->SMTPDebug = 0;
              //$mail->Debugoutput = 'html';
              $mail->Host = MAIL_HOST;
              $mail->Port = MAIL_PORT;
              $mail->SMTPSecure = MAIL_SMTPSECURE;
              $mail->SMTPAuth = MAIL_SMTPAUTH;
              $mail->Username = MAIL_USERNAME;
              $mail->Password = MAIL_PASSWORD;
              $mail->setFrom(MAIL_USERNAME, 'Gestión Productiva de la Universidad Nacional de San Agustin');
              $mail->addReplyTo(MAIL_USERNAME, 'Gestión Productiva de la Universidad Nacional de San Agustin');
              $mail->addAddress($email, $username);
              $mail->CharSet = 'utf-8';
              $mail->Subject = 'Restablecer Contraseña';
              //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
              $mail->isHTML(true);   
              $mail->Body = 'Hola, <br/> <br/>Su usuario es: '.$username.' <br><br>Click aqui para resetear su contraseña '.BASE_URL.'Usuarios/ResetPassword/'.$token.'<br/> <br/>--<br>UNSA<br>Si usted no solicito restablecer su contraseña, ignore este mensaje y cambie su contraseña por seguridad.';
              if (!$mail->send()) {
                  return false;
                  //echo "Mailer Error: " . $mail->ErrorInfo;
              } else {
                  return true;
                  //echo "Message sent!";
              }
                //$message = "Your password reset link send to your e-mail address.";
        }
    }

?>