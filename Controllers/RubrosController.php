<?php
    require_once("Core/Session.php");
    require_once 'Models/RubroModel.php';
    
    if ($_SESSION['TipoUsuario']==0){
        header('Location:'.BASE_URL.'Home');       
    }
    
    class RubrosController{
        
        private $model;
        private $rubro;
        private $auxTable;

        public function __construct(){
            $this->model = new Rubro();
            $this->auxTable = "Rubros";
        }
        
        public function Index(){

            $rubro = new Rubro();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Rubros/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $rubro = new Rubro();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            if(isset($_REQUEST['Id'])){
                $rubro = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Rubros/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Rubros/pagination.php';
        }

        public function Guardar(){
            $rubro = new Rubro();
            
            $rubro->Id = $_REQUEST['Id'];
            $rubro->Descripcion = $_REQUEST['Descripcion'];

            $rubro->Id > 0 
                ? $this->model->Actualizar($rubro)
                : $this->model->Registrar($rubro);
            
            header('Location:'.BASE_URL.'Rubros');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Rubros');
        }
    }
?>