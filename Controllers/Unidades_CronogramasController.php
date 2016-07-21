<?php
    require_once("Core/Session.php");
    require_once 'Models/Unidad_CronogramaModel.php';

    class Unidades_CronogramasController{
        
        private $model;
        private $unidad;
        
        public function __construct(){
            $this->model = new Unidad_Cronograma();
        }
        
        public function Index(){
            $unidad = new Unidad_Cronograma();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Unidades_Cronogramas/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $unidad = new Unidad_Cronograma();
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
            require_once 'Views/Unidades_Cronogramas/update.php';
            require_once 'Views/footer.php';
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Unidades_Cronogramas/pagination.php';
        }
        
        public function Guardar(){
            $unidad = new Unidad_Cronograma();
            
            $unidad->Id = $_REQUEST['Id'];
            $unidad->Unidad_Id = $_REQUEST['Unidad_Id'];
            $unidad->Cronograma_Id = $_REQUEST['Cronograma_Id'];
         

            $unidad->Id > 0 
                ? $this->model->Actualizar($unidad)
                : $this->model->Registrar($unidad);
            
            header('Location:'.BASE_URL.'Unidades_Cronogramas');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Unidades_Cronogramas');
        }
    }
?>