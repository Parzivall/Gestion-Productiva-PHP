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
    }

?>