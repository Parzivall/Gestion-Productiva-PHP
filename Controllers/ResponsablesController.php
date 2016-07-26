<?php
    require_once("Core/Session.php");
    require_once 'Models/ResponsableModel.php';

    if ($_SESSION['TipoUsuario']==0){
        header('Location:'.BASE_URL.'Home');       
    }
    
    class ResponsablesController{
        
        private $model;
        private $responsable;
        private $auxTable;
        
        public function __construct(){
            $this->model = new Responsable();
            $this->auxTable = "Responsables";
        }
        
        public function Index(){
            $responsable = new Responsable();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Responsables/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $responsable = new Responsable();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            if(isset($_REQUEST['Id'])){
                $responsable = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Responsables/index.php';
            require_once 'Views/footer.php';
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Responsables/pagination.php';
        }
        
        public function Guardar(){
            $responsable = new Responsable();
            
            $responsable->Id = $_REQUEST['Id'];
            $responsable->Unidad_Id = $_REQUEST['Unidad'];
            $responsable->Persona_Dni = $_REQUEST['Persona'];
            
            $responsable->Id > 0 
                ? $this->model->Actualizar($responsable)
                : $this->model->Registrar($responsable);
            
            header('Location:'.BASE_URL.'Responsables');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Responsables');
        }
    }
?>