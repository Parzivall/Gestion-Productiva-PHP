<?php 
	require_once("Core/Session.php");
	require_once ('Models/InventarioBienesModel.php');
	require_once("Models/BienesModel.php");
	require_once("Models/TipoMaterialModel.php");

	class InventarioBienesController
	{
		private $model;
		public $Inventariobienes;
		public $auxTable;
		public $modelbien;
		public $modeltipomaterial;
		public function __construct()
		{
			$this->model    = new InventarioBienes();
			$this->modelbien= new Bienes();
			$this->auxTable = "InventarioBienes"; 
			$this->modeltipomaterial = new TipoMaterial();
		}
		public function Index()
		{
			$Inventariobienes = new InventarioBienes();
				$totalRecords = $this->model->getTotalRecords();
				$toalPages = ceil($totalRecords/resultsPerPage);
				if (isset($_GET["page"])) 
					{ $page  = $_GET["page"]; } else { $page=1; };
				$startFrom = ($page-1) * resultsPerPage; 
    require_once 'Views/header.php';
    require_once 'Views/sidebar.php';
    require_once 'Views/panel.php';
    require_once 'Views/InventarioBienes/index.php';
    require_once 'Views/footer.php';
		}
		public function Crud()
		{
			$Inventariobienes = new InventarioBienes();
			if(isset($_REQUEST['Id']))
			{
				$Inventariobienes = $this->model->Obtener($_REQUEST['Id']);
			}
   require_once 'Views/header.php';
   require_once 'Views/sidebar.php';
   require_once 'Views/panel.php';
   require_once 'Views/InventarioBienes/update.php';
   require_once 'Views/footer.php';
		}
		public function Guardar()
		{
			$Inventariobienes= new InventarioBienes();
			$Inventariobienes->Id=$_REQUEST['Id'];
			$Inventariobienes->Cantidad=$_REQUEST['Cantidad'];
			$Inventariobienes->Estado=$_REQUEST['Estado'];
			$Inventariobienes->Observaciones=$_REQUEST['Observaciones'];
			$Inventariobienes->EstadoOperativo=$_REQUEST['Operatividad'];
			$Inventariobienes->Unidad_Id=$_REQUEST['Unidad'];
			$Inventariobienes->Fecha_Ingreso=$_REQUEST['Fecha_Ingreso'];
			$Inventariobienes->Id > 0 
    ? $this->model->Actualizar($Inventariobienes)
    : $this->model->Registrar($Inventariobienes);
   header('Location:'.BASE_URL.'InventarioBienes');
		}
		public function Eliminar()
		{
			$this->model->Eliminar($_REQUEST['Id']);
			header('Location:'.BASE_URL.'InventarioBienes');

		}
	}
?>