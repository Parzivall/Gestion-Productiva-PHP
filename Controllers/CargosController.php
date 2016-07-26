<?php
    require_once("Core/Session.php");
    require_once 'Models/CargoModel.php';
    
    if ($_SESSION['TipoUsuario']==0){
        header('Location:'.BASE_URL.'Home');       
    }
    
    class CargosController{
        
        private $model;
        private $cargo;
        private $auxTable;

        public function __construct(){
            $this->model = new Cargo();
            $this->auxTable = "Cargos";
        }
        
        public function Index(){

            $cargo = new Cargo();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Cargos/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $cargo = new Cargo();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            if(isset($_REQUEST['Id'])){
                $cargo = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Cargos/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Cargos/pagination.php';
        }

        public function Guardar(){
            $cargo = new Cargo();
            
            $cargo->Id = $_REQUEST['Id'];
            $cargo->Descripcion = $_REQUEST['Descripcion'];
            //$cargo->CargoSuperior = $_REQUEST['CargoSuperior'];

            $cargo->Id > 0 
                ? $this->model->Actualizar($cargo)
                : $this->model->Registrar($cargo);
            
            header('Location:'.BASE_URL.'Cargos');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Cargos');
        }
    }
?>