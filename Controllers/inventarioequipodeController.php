<?php 
	require_once("Core/Session.php");
    require_once ('Models/InventarioEquipoModel.php');
    //require_once 'Models/UnidadMedidaModel.php';
    
   /* if ($_SESSION['TipoUsuario']==0){
        header('Location:'.BASE_URL.'Home');       
    } si es usuario u otro */


    class InventarioEquipoController{
        
        private $model;
        public $Inventarioequipo;
        public $auxTable;
        
        public function __construct(){
            
            $this->model = new InventarioEquipo();
            //$this->modelTipoComprobante = new TipoComprobantePago();
        }

        public function Index()
        {
        	$Inventarioequipo = new InventarioEquipo();
            $totalRecords = $this->model->getTotalRecords();//el grado el numero de fila
            echo "la cantidad de filas $totalRecords ";
            echo resultsPerPage;
            $totalPages = ceil($totalRecords/resultsPerPage);//este da el màs alto valor es el techo
            if (isset($_GET["page"])) 
                { $page  = $_GET["page"]; } else { $page=1; }; 
            echo "hace una consulta $page";
            $startFrom = ($page-1) * resultsPerPage;
            echo "entonces starfrom tiene $startFrom";
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Inventarioequipo/index.php';
            require_once 'Views/footer.php';
        }
        


        public function Crud(){//es donde se llena los datos
            $Inventarioequipo = new InventarioEquipo();

            if(isset($_REQUEST['Id'])){
                
                $Inventarioequipo = $this->model->Obtener($_REQUEST['Id']);
            }

            $incremento=0;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Inventarioequipo/update.php';
            require_once 'Views/footer.php';

           // header('Location:'.BASE_URL.'Inventarioequipo');
        }

        public function Guardar(){
            $Inventarioequipo = new InventarioEquipo();
            
            $Inventarioequipo->Id = $_REQUEST['Id'];
            
            $Inventarioequipo->Unidad_Id = $_REQUEST['Unidad']; 
            $Inventarioequipo->TipoExistencia_Id = $_REQUEST['TipoInventario'];
            $Inventarioequipo->UnidadMedida_Id = $_REQUEST['UnidadMedida'];
            $Inventarioequipo->Periodo = $_REQUEST['Periodo'];
            $Inventarioequipo->Descripcion_Existencia = $_REQUEST['Descripcion'];
           // $Inventarioequipo->Codigo_Existencia = $_REQUEST['codigo'];     
            
            $Inventarioequipo->Id > 0 

                ? $this->model->Actualizar($Inventarioequipo)
                : $this->model->Registrar($Inventarioequipo);
            
            header('Location:'.BASE_URL.'Inventarioequipo');
        }

        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            //header('Location:'.BASE_URL.'Inventarioequipo');
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Inventarioequipo/pagination.php';
        }        

    }
?>