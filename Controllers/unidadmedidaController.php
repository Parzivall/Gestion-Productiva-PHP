<?php
	
	require_once("Core/Session.php");
    require_once 'Models/UnidadMedidadModel.php';

	class UnidadMedidaController
	{
		private $Unidadmedida;
		private $auxTable;
		private $model;
		public function __construct()
		{
			$this->auxTable = "UnidadMedida";//esto es muy importante
			$this->model= new UnidadMedida();
		}

		public function index()
		{
			//$model= new UnidadMedida();
			$Unidadmedida = new UnidadMedida(); 

            $totalRecords = $this->model->getTotalRecords();

            $totalPages = ceil($totalRecords/resultsPerPage);

            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            //creo el get es para averiguar si esta funcionando corectamente page
            $startFrom = ($page-1) * resultsPerPage;
           
            
			require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/UnidadMedida/index.php';
            require_once 'Views/footer.php';
		}

        public function Crud()
        {
            $Unidadmedida = new UnidadMedida();

            $totalRecords = $this->model->getTotalRecords();
            

            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;

            if(isset($_REQUEST['Id'])){
                $Unidadmedida = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/UnidadMedida/index.php';
            require_once 'Views/footer.php';
        }

		public function Guardar(){
            $Unidadmedida = new UnidadMedida();
            
            $Unidadmedida->Id = $_REQUEST['Id'];
            $Unidadmedida->Descripcion = $_REQUEST['Descripcion'];

            if ($Unidadmedida->Id > 0 )
               { $this->model->Actualizar($Unidadmedida);}
            else
                {   echo "dentra acas";
                    $this->model->Registrar($Unidadmedida);}
            
           header('Location:'.BASE_URL.'UnidadMedida');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'UnidadMedida');
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/UnidadMedida/pagination.php';
        } 
	} 

?>