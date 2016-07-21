<?php
    require_once("Core/Session.php");
    require_once 'Models/UnidadPersonaModel.php';

    class UnidadesPersonasController{
        
        private $model;
        private $unidadPersona;
        private $auxTable;

        public function __construct(){
            $this->model = new UnidadPersona();
            $this->auxTable = "UnidadesPersonas";
        }
        
        public function Index(){
            $unidadPersona = new UnidadPersona();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/UnidadesPersonas/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $unidadPersona = new UnidadPersona();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;

            if(isset($_REQUEST['Id'])){
                $unidadPersona = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/UnidadesPersonas/index.php';
            require_once 'Views/footer.php';
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/UnidadesPersonas/pagination.php';
        }
        
        public function Guardar(){
            $unidadPersona = new UnidadPersona();
            
            $unidadPersona->Id = $_REQUEST['Id'];
            $unidadPersona->Persona_Dni = $_REQUEST['Persona'];
            $unidadPersona->Unidad_Id = $_REQUEST['Unidad'];
            $unidadPersona->Cargo_Id = $_REQUEST['Cargo'];
            
            $unidadPersona->Id > 0 
                ? $this->model->Actualizar($unidadPersona)
                : $this->model->Registrar($unidadPersona);
            
            header('Location:'.BASE_URL.'UnidadesPersonas');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'UnidadesPersonas');
        }
    }
?>