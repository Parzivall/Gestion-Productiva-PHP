<?php
    require_once("Core/Session.php");
    require_once 'Models/InventarioFisicoDetalleModel.php';
    require_once 'Models/MaterialInsumoModel.php';
	class InventarioFisicoDeController
	{
		private $model;
		public $Materialinsumo;
		public $Inventariofisicode;
        public $modeldetalle;
		public function __construct()
		{
			$this->model=new Inventariofisicode(); 
			$this->Materialinsumo=new Material_Insumo();
            $this->modeldetalle=new InventarioFisicoDe();
		}

		public function Index()
        {
            $Inventariofdetalle = new InventarioFisicoDe();
            
            $totalRecords = $this->model->getTotalRecords();//el grado el numero de filas
            $totalPages = ceil($totalRecords/resultsPerPage);
            
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                $startFrom = ($page-1) * resultsPerPage;
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/InventarioFisico/index.php';
            require_once 'Views/footer.php';
        }

        public function Crud(){//es donde se llena los datos
            $Inventariofisicode = new InventarioFisicoDe();

            if(isset($_REQUEST['Id'])){
                
                $Inventariofisico = $this->model->Obtener($_REQUEST['Id']);
            }

            $incremento=0;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/InventarioFisico/update.php';
            require_once 'Views/footer.php';

           // header('Location:'.BASE_URL.'InventarioFisico');
        }

        public function Guardar(){

            $Inventariofisicode = new InventarioFisicoDe($Inventariofisicode);
            $Inventariofisicode->Id = $_REQUEST['Id'];//porque el request rescato con otro
            $Inventariofisicode->Cantidad = $_REQUEST['Cantidad']; 
            $Inventariofisicode->Estado = $_REQUEST['Estado'];
            $Inventariofisicode->Edad= $_REQUEST['Edad'];
            $Inventariofisicode->Observaciones = $_REQUEST['Observaciones'];
            $Inventariofisicode->InventarioFisico_Id= $_REQUEST['InventarioFisico_Id'];
            $Inventariofisicode->Material_Insumo_Id = $_REQUEST['Material_Insumo_Id'];     
   
            $Inventariofisicode->Id > 0 
                ? $this->model->Actualizar($Inventariofisicode)
                : $this->model->Registrar($Inventariofisicode);
            
            $detalles = array_values($detalles);

            header('Location:'.BASE_URL.'InventarioFisico');
        }

        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            //header('Location:'.BASE_URL.'Inventariofisico');
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/InventarioFisicoDe/pagination.php';
        } 

	}
 ?>