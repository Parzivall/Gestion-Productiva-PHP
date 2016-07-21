<?php
require_once("Core/Session.php");
require_once 'Models/alumno.php';

class AlumnosController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Alumno();

    }
    
    public function Index(){
        require_once 'views/header.php';
        require_once 'views/alumno/alumno.php';
        require_once 'views/footer.php';
    }
    
    public function Crud(){
        $alm = new Alumno();
        
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'views/header.php';
        require_once 'views/alumno/alumno-editar.php';
        require_once 'views/footer.php';
    }
    
    public function Guardar(){
        $alm = new Alumno();
        
        $alm->id = $_REQUEST['id'];
        $alm->Nombre = $_REQUEST['Nombre'];
        $alm->Apellido = $_REQUEST['Apellido'];
        $alm->Correo = $_REQUEST['Correo'];
        $alm->Sexo = $_REQUEST['Sexo'];
        $alm->FechaNacimiento = $_REQUEST['FechaNacimiento'];

        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
        
        header('Location:'.BASE_URL.'index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location:'.BASE_URL.'index.php');
    }
}