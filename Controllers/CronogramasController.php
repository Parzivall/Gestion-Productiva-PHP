<?php
    require_once("Core/Session.php");
    require_once 'Models/CronogramaModel.php';

    class CronogramasController{
        
        private $model;
        private $cronograma;
        //private $auxTable;
        
        public function __construct(){
            $this->model = new Cronograma();
            //$this->auxTable = "Responsables";
        }
        
        public function Index(){
            $cronograma = new Cronograma();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Cronogramas/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $cronograma = new Cronograma();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            if(isset($_REQUEST['Id'])){
                $cronograma = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Cronogramas/index.php';
            require_once 'Views/footer.php';
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Cronogramas/pagination.php';
        }
        
        public function Guardar(){
            $cronograma = new Cronograma();
            
            if (isset($_REQUEST['Cumplido'])){
                $cronograma->Cumplido = true;
            } else {
                $cronograma->Cumplido = false;
            }

            $cronograma->Id = $_REQUEST['Id'];
            $cronograma->Descripcion = $_REQUEST['Descripcion'];
            $cronograma->FechaInicio = $_REQUEST['FechaInicio'];
            $cronograma->FechaFin = $_REQUEST['FechaFin'];
            $cronograma->Unidad_Id = $_REQUEST['Unidad'];

            $cronograma->Id > 0 
                ? $this->model->Actualizar($cronograma)
                : $this->model->Registrar($cronograma);
            
            header('Location:'.BASE_URL.'Cronogramas');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Cronogramas');
        }
    }
?>