<?php
    require_once("Core/Session.php");
    require_once 'Models/DirectorioModel.php';

    class DirectorioController{
        
        private $model;
        private $directorio;
        
        public function __construct(){
            $this->model = new Directorio();
        }
        
        public function Index(){
            $directorio = new Directorio();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Directorio/index.php';
            require_once 'Views/footer.php';
        }

        public function Paginacion(){
            if (isset($_GET["search"])) { $search  = $_GET["search"]; } else { $search=''; };  
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Directorio/paginationsearch.php';
        }

        public function Buscar(){
            $search = '';
            $directorio = new Directorio();
            if (isset($_POST["search"])) { $search  = $_POST["search"]; } else { $search=''; };  
            $totalRecords = $this->model->getTotalRecordsBusqueda($search);
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Directorio/fetch.php';
        }
        
        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Directorio/pagination.php';
        }
    }
?>