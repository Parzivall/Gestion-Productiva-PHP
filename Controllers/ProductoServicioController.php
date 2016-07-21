<?php
    require_once("Core/Session.php");
    require_once 'Models/ProductoServicioModel.php';

    class ProductoServicioController{
        
        private $model;
        private $unidad;
        
        public function __construct(){
            $this->model = new ProductoServicio();
        }
        
        public function Index(){
            $unidad = new ProductoServicio();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/ProductoServicio/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $unidad = new ProductoServicio();
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
            require_once 'Views/ProductoServicio/update.php';
            require_once 'Views/footer.php';
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/ProductoServicio/pagination.php';
        }
        
        public function Guardar(){
            $unidad = new ProductoServicio();
            
            $unidad->Id = $_REQUEST['Id'];
            $unidad->TipoProductoServicio = $_REQUEST['TipoProductoServicio'];
            $unidad->Descripcion = $_REQUEST['Descripcion'];
            $unidad->Imagen = $_REQUEST['Imagen'];
            $unidad->Tipo = $_REQUEST['Tipo'];


            $unidad->Id > 0 
                ? $this->model->Actualizar($unidad)
                : $this->model->Registrar($unidad);
            
            header('Location:'.BASE_URL.'ProductoServicio');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'ProductoServicio');
        }
    }
?>