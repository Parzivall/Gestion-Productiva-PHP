<?php

    require_once 'Models/UsuarioModel.php';

    class UsuariosController
    {
        private $model;

        function __construct()
        {
            $this->model = new Usuario();

        }

        public function Logout(){
            $this->model->Logout();
            header('Location:'.BASE_URL);
        }

        public function Login(){
            $Usuario = new Usuario();
            $Usuario->Username = $_REQUEST['Username'];
            $Usuario->Password = $_REQUEST['Password'];
            if ($this->model->Login($Usuario)){
                header('Location:'.BASE_URL);
            }
            else
            {
                header('Location:'.BASE_URL.'Usuarios/Error');
            }          
        }

        public function Error(){
            $error= "Usuario o Contraseña incorrectos";
            require_once 'views/Usuarios/login.php';
        }

        public function Index(){
            if ($this->model->isLoggedIn())
            {
                header('Location:'.BASE_URL.'Home');
            }
            else
            {
                require_once 'views/Usuarios/login.php';
            }    
        }
        
        public function Registro(){
            $usuario = new Usuario();
            
            require_once 'views/Usuarios/registro.php';
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