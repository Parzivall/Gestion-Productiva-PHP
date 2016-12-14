<?php
	
	require_once("Core/Session.php");
    require_once 'Models/TipoMaterialModel.php';

	class TipoMaterialController
	{
		private $tipomaterial;
		private $auxTable;
		private $model;
		public function __construct()
		{
			$this->auxTable = "TipoMaterial";//esto es muy importante
			$this->model= new TipoMaterial();
		}

		public function index()
		{
			//$model= new UnidadMedida();
			$tipomaterial = new TipoMaterial(); 

            $totalRecords = $this->model->getTotalRecords();

            $totalPages = ceil($totalRecords/resultsPerPage);

            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            //creo el get es para averiguar si esta funcionando corectamente page
            $startFrom = ($page-1) * resultsPerPage;
           
            
			require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/TipoMaterial/index.php';
            require_once 'Views/footer.php';
		}

        /*public function Crud()
        {
            $tipomaterial = new TipoExistencia();

            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                $startFrom = ($page-1) * resultsPerPage;

            if(isset($_REQUEST['Id'])){
                $tipomaterial = $this->model->Obtener($_REQUEST['Id']);
                echo "debe dentrar acas ";
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/UnidadMedida/index.php';
            require_once 'Views/footer.php';
        }*/

		public function Guardar(){
            $tipomaterial = new TipoMaterial();
            
            $tipomaterial->Id = $_REQUEST['Id'];
            $tipomaterial->Descripcion = $_REQUEST['Descripcion'];

            if ($tipomaterial->Id > 0 )
               { $this->model->Actualizar($tipomaterial);}
            else
            {   echo "dentra acas";
                $this->model->Registrar($tipomaterial); 
            }
            
           header('Location:'.BASE_URL.'TipoMaterial');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'TipoMaterial');
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/TipoMaterial/pagination.php';
        } 
	} 

?>