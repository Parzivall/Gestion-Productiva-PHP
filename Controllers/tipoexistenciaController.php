<?php
	
	require_once("Core/Session.php");
    require_once 'Models/TipoExistenciaModel.php';

	class TipoExistenciaController
	{
		private $tipoexistencia;
		private $auxTable;
		private $model;
		public function __construct()
		{
			$this->auxTable = "TipoExistencia";//esto es muy importante
			$this->model= new TipoExistencia();
		}

		public function index()
		{
			//$model= new UnidadMedida();
			$tipoexistencia = new TipoExistencia(); 

            $totalRecords = $this->model->getTotalRecords();

            $totalPages = ceil($totalRecords/resultsPerPage);

            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            //creo el get es para averiguar si esta funcionando corectamente page
            $startFrom = ($page-1) * resultsPerPage;
           
            
			require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/TipoExistencia/index.php';
            require_once 'Views/footer.php';
		}

        public function Crud()
        {
            $tipoexistencia = new TipoExistencia();

            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                $startFrom = ($page-1) * resultsPerPage;

            if(isset($_REQUEST['Id'])){
                $tipoexistencia = $this->model->Obtener($_REQUEST['Id']);
                echo "debe dentrar acas ";
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/UnidadMedida/index.php';
            require_once 'Views/footer.php';
        }

		public function Guardar(){
            $tipoexistencia = new TipoExistencia();
            
            $tipoexistencia->Id = $_REQUEST['Id'];
            $tipoexistencia->Descripcion = $_REQUEST['Descripcion'];

            if ($Unidadmedida->Id > 0 )
               { $this->model->Actualizar($tipoexistencia);}
            else
            {   echo "dentra acas";
                $this->model->Registrar($tipoexistencia); 
            }
            
           header('Location:'.BASE_URL.'TipoExistencia');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'TipoExistencia');
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/TipoExistencia/pagination.php';
        } 
	} 

?>