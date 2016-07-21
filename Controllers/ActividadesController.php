<?php
    require_once("Core/Session.php");
    require_once 'Models/ActividadModel.php';

    class ActividadesController{
        
        private $model;
        private $unidad;
        
        public function __construct(){
            $this->model = new Actividad();
        }
        
        public function Index(){
            $unidad = new Actividad();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Actividades/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $unidad = new Actividad();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;

            if(isset($_REQUEST['Id'])){
                $unidad = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Actividades/update.php';
            require_once 'Views/footer.php';
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Actividades/pagination.php';
        }
        
        public function Guardar(){
            $unidad = new Actividad();
            
            $unidad->FechaInicio = $_REQUEST['FechaInicio'];
            $unidad->FechaFin = $_REQUEST['FechaFin'];
            $unidad->Descripcion = $_REQUEST['Descripcion'];

            $unidad->Id > 0 
                ? $this->model->Actualizar($unidad)
                : $this->model->Registrar($unidad);
            
            header('Location:'.BASE_URL.'Actividades');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Actividades');
        }
    }
?>