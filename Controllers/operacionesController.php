<?php
    require_once("Core/Session.php");
    require_once 'Models/OperacionModel.php';
    require_once 'Models/DetalleOperacionModel.php';
    
    class OperacionesController{
        
        private $model;
        private $operacion;
        private $modelDetalleOperacion;
        private $detallesTemporales;

        public function __construct(){
            $this->model = new Operacion();
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
                $detallesTemporales = $this->modelDetalleOperacion->getDetallesByOperacionId($_REQUEST['Id']);
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
            $contador=0;
            foreach($_REQUEST['IdDetalle'] as $detalle) {
                $detalles[$contador][2] = $detalle;
                $contador++;
            }

            $operacion = new Operacion();
            $operacion->Id = $_REQUEST['Id'];
            $operacion->Tipo = $_REQUEST['Tipo'];
            $operacion->Monto = $_REQUEST['Monto'];
            $operacion->Unidad_Id = $_REQUEST['Unidad'];
            $operacion->Fecha = $_REQUEST['Fecha'];
            $detallesTemporales = $this->modelDetalleOperacion->getDetallesArrayByOperacionId($operacion->Id);

            if ($operacion->Id > 0){
                $this->model->Actualizar($operacion);
                //Comparar los detalles nuevos con los anteriores
                $contador2=0;
                $tamDT = count($detallesTemporales);
                for ($i=0; $i < $contador; $i++) { 
                    //actualizar los detalles que ya estan en la base de datos
                    for ($j=0; $j < $tamDT; $j++) { 
                        if ($detalles[$i][2] == $detallesTemporales[$j][0]){
                            $detalle = new Detalle();
                            $detalle->Id = $detalles[$i][2];
                            $detalle->Descripcion = $detalles[$i][0];
                            $detalle->Monto = $detalles[$i][1];
                            $this->modelDetalle->Actualizar($detalle);
                            unset($detalles[$i]); //Eliminar de los nuevos detalles
                            unset($detallesTemporales[$j]);
                            $detallesTemporales = array_values($detallesTemporales);
                            break;
                        }
                    }
                    $tamDT =count($detallesTemporales);
                }

                $detalles = array_values($detalles);
                
                file_put_contents('php://stderr', print_r("LLEGO HASTA EL PUNTO DE ELIMINACION", TRUE));
                //Eliminamos los detalles que ya no esten en la base de datos
                for ($i=0; $i < count($detallesTemporales); $i++) { 
                    file_put_contents('php://stderr', print_r("Eliminando Detalle", TRUE));
                    $this->modelDetalleOperacion->EliminarByIds($operacion->Id,$detallesTemporales[$i][0]);
                    $this->modelDetalle->Eliminar($detallesTemporales[$i][0]);    
                }


                //Para insertar los detalles
                for ($i=0; $i < count($detalles); $i++) { 
                    $detalle = new Detalle();
                    $detalle->Descripcion = $detalles[$i][0];
                    $detalle->Monto = $detalles[$i][1];
                    $lastIdDetalle = $this->modelDetalle->Registrar($detalle);
                    $detalleOperacion = new DetalleOperacion();
                    $detalleOperacion->Operacion_Id = $operacion->Id;
                    $detalleOperacion->Detalle_Id = $lastIdDetalle;
                    $this->modelDetalleOperacion->Registrar($detalleOperacion);
                }
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