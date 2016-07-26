<?php

require_once("Core/Session.php");
require_once 'Models/PersonaModel.php';

class PersonasController{
    
    private $model;
    private $persona;
    
    public function __construct(){
        $this->model = new Persona();

    }
    
    public function Index(){
        $persona = new Persona();
        $totalRecords = $this->model->getTotalRecords();
        $totalPages = ceil($totalRecords/resultsPerPage);
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;
        require_once 'Views/header.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/panel.php';
        require_once 'Views/Personas/index.php';
        require_once 'Views/footer.php';
    }
    
    public function Crud(){
        $persona = new Persona();
        $totalRecords = $this->model->getTotalRecords();
        $totalPages = ceil($totalRecords/resultsPerPage);
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;

        if(isset($_REQUEST['Dni'])){
            $persona = $this->model->Obtener($_REQUEST['Dni']);
        }
        require_once 'Views/header.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/panel.php';
        require_once 'Views/Personas/update.php';
        require_once 'Views/footer.php';
    }

    public function Pagination(){
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;
        require_once 'Views/Personas/pagination.php';
    }

    public function Verificar(){
        require_once 'Views/Personas/check_availability.php';
    }
    
    public function Guardar(){
        $persona = new Persona();
        
        $DniUpdate = $_REQUEST['DniUpdate'];
        $persona->Dni = $_REQUEST['Dni'];
        $persona->Username = $_REQUEST['Username'];
        $persona->Password = $_REQUEST['Password'];
        $persona->Nombres = $_REQUEST['Nombres'];
        $persona->Apellidos = $_REQUEST['Apellidos'];
        $persona->Direccion = $_REQUEST['Direccion'];
        $persona->Telefono = $_REQUEST['Telefono'];
        $persona->Email = $_REQUEST['Email'];
        $persona->Web = $_REQUEST['Web'];
        $persona->Nacimiento = $_REQUEST['Nacimiento'];
        $persona->Genero = $_REQUEST['Genero'];
        //$persona->Foto = $_REQUEST['Foto'];
        $persona->Informacion = $_REQUEST['Informacion'];

        if ($DniUpdate!="-1"){
            $persona->Dni = $_REQUEST['DniUpdate'];
            $this->model->Actualizar($persona);
        }else{
            $this->model->Registrar($persona);
        }
        
        header('Location:'.BASE_URL.'Personas');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['Dni']);
        header('Location:'.BASE_URL.'Personas');
    }
}