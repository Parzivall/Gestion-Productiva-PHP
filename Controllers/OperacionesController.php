<?php
    require_once("Core/Session.php");
    require_once 'Models/OperacionModel.php';
    require_once 'Models/DetalleModel.php';
    require_once 'Models/DetalleOperacionModel.php';
    
    class OperacionesController{
        
        private $model;
        private $operacion;
        private $modelDetalle;
        private $modelDetalleOperacion;

        public function __construct(){
            $this->model = new Operacion();
            $this->modelDetalle = new Detalle();
            $this->modelDetalleOperacion = new DetalleOperacion();
        }
        
        public function Index(){
            $operacion = new Operacion();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Operaciones/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $operacion = new Operacion();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            if(isset($_REQUEST['Id'])){
                $operacion = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Operaciones/update.php';
            require_once 'Views/footer.php';
        }
        
        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Operaciones/pagination.php';
        }

        public function Guardar(){
            $contador = 0;
            $contador2 = 0;
            $detalles = array();

            //Obtener los datos de la tabla
            //file_put_contents('php://stderr', print_r($detalle, TRUE));
            foreach($_REQUEST['DescripcionDetalle'] as $detalle) {
                $detalles[$contador] = array($detalle, "");
                
                $contador++;
            }
            $contador=0;
            foreach($_REQUEST['MontoDetalle'] as $detalle) {
                $detalles[$contador][1] = $detalle;
                $contador++;
            }

            $operacion = new Operacion();
            $operacion->Id = $_REQUEST['Id'];
            $operacion->Tipo = $_REQUEST['Tipo'];
            $operacion->Monto = $_REQUEST['Monto'];
            $operacion->Unidad_Id = $_REQUEST['Unidad'];
            $operacion->Fecha = $_REQUEST['Fecha'];

            if ($operacion->Id > 0){
                $this->model->Actualizar($operacion);
            }else {
                $lastIdOperacion = $this->model->Registrar($operacion); //Registrar cabecera y obtener id generado
                $detalle = new Detalle();

                //Para insertar los detalles
                for ($i=0; $i < $contador; $i++) { 
                    $detalle = new Detalle();
                    $detalle->Descripcion = $detalles[$i][0];
                    $detalle->Monto = $detalles[$i][1];
                    $lastIdDetalle = $this->modelDetalle->Registrar($detalle);
                    $detalleOperacion = new DetalleOperacion();
                    $detalleOperacion->Operacion_Id = $lastIdOperacion;
                    $detalleOperacion->Detalle_Id = $lastIdDetalle;
                    $this->modelDetalleOperacion->Registrar($detalleOperacion);
                }

                //Para enlazar los detalles insertados con La operacion Insertada
            }
            header('Location:'.BASE_URL.'Operaciones');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Operaciones');
        }
    }
?>