<?php
    require_once("Core/Session.php");
    require_once 'Models/CiudadModel.php';

    //Redireccionar a Home, los usuarios normales no pueden modificar las tablas auxiliares
    if ($_SESSION['TipoUsuario']==0){
        header('Location:'.BASE_URL.'Home');       
    }
    
    class CiudadesController{
        
        private $model;
        private $ciudad;
        private $auxTable;
        public function __construct(){
            $this->model = new Ciudad();
            $this->auxTable = "Ciudades";
        }
        
        public function Index(){
            $ciudad = new Ciudad();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Ciudades/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $ciudad = new Ciudad();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            if(isset($_REQUEST['Id'])){
                $ciudad = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Ciudades/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Ciudades/pagination.php';
        }

        public function Guardar(){
            $ciudad = new Ciudad();
            
            $ciudad->Id = $_REQUEST['Id'];
            $ciudad->Nombre = $_REQUEST['Nombre'];

            $ciudad->Id > 0 
                ? $this->model->Actualizar($ciudad)
                : $this->model->Registrar($ciudad);
            
            header('Location:'.BASE_URL.'Ciudades');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Ciudades');
        }
    }
?>