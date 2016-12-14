<?php 
	require_once("Core/Session.php");
    require_once ('Models/InventarioEquiposModel.php');
    require_once ('Models/EquiposModel.php');

    class InventarioEquiposController{
        
        private $model;
        public $Inventarioequipos;
        public $auxTable;
        public $modelequipo;
        public function __construct(){
            $this->auxTable    = "InventarioEquipo";    
            $this->model       = new InventarioEquipos();
            $this->modelequipo = new Equipos();
        }

        public function Index()
        {
        	$Inventarioequipos = new InventarioEquipos();

            //echo "la cantidad de filas $totalRecords ";
            //echo resultsPerPage;
            if( isset($_SESSION['Unidad_Id'] )) {
                $unidadid=$_SESSION['Unidad_Id'];
                $totalRecords=$this->model->getTotalRecordsporUnnidad($unidadid);
            }
            else
            {
                $totalRecords = $this->model->getTotalRecords();//el grado el numero de fila
            }

            $totalPages = ceil($totalRecords/resultsPerPage);//este da el màs alto valor es el techo
            if (isset($_GET["page"])) 
                { $page  = $_GET["page"]; } else { $page=1; }; 
            echo "hace una consulta $page";
            $startFrom = ($page-1) * resultsPerPage;
            echo "entonces starfrom tiene $startFrom";
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Inventarioequipos/index.php';
            require_once 'Views/footer.php';
        }
        


        public function Crud(){//es donde se llena los datos
            $Inventarioequipos = new InventarioEquipos();

            if(isset($_REQUEST['Id'])){
                
                $Inventarioequipos = $this->model->Obtener($_REQUEST['Id']);
            }

            $incremento=0;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/InventarioEquipos/update.php';
            require_once 'Views/footer.php';

           // header('Location:'.BASE_URL.'Inventarioequipo');
        }

        public function Guardar(){
            $Inventarioequipos = new InventarioEquipos();
            $contador = 0;
            $detalleequipotmp = array();

            foreach($_REQUEST["Descripcion1"] as $desequipo)
            {    $detalleequipotmp[$contador]=array($desequipo,"");//recogiendo los datos
                //no se porque ""
                $contador++;
            }

            $contador = 0;
            foreach($_REQUEST["IdDetalle1"] as $idequipo)
            {   $detalleequipotmp[$contador][1] =$idequipo;
                $contador++;
            }

            $contador = 0;
            foreach($_REQUEST["Marca1"] as $desequipo)
            {    $detalleequipotmp[$contador][2] =$desequipo;
                $contador++;
            }

            $contador=0;
            foreach($_REQUEST["Modelo1"] as $moequipo)
            {   $detalleequipotmp[$contador][3]=$moequipo;
                $contador++;
            }

            $contador=0;
            foreach($_REQUEST["NumeroS1"] as $numerodesequipo)
            {   $detalleequipotmp[$contador][4]=$numerodesequipo;
                echo "numerodeserie $numerodesequipo";
                $contador++;
            }

            $contador=0;
            foreach($_REQUEST["Fabricado1"] as $faequipo)
            { $detalleequipotmp[$contador][5]=$faequipo;
                $contador++;
            }

            echo "la cantidad de elemententos aumentados $contador";
            $Inventarioequipos->Id = $_REQUEST['Id'];
            $Inventarioequipos->Unidad_Id = $_REQUEST['Unidad']; 
            $Inventarioequipos->Fecha_Ingreso = $_REQUEST['Fecha_Ingreso'];
            $Inventarioequipos->Condicion = $_REQUEST['Condicion']; 
            $Inventarioequipos->EstadoOperativo = $_REQUEST['EstadoOperativo'];
            $Inventarioequipos->Observaciones = $_REQUEST['Observaciones']; 
            $id_inventarioequipo = $Inventarioequipos->Id;
            if($Inventarioequipos->Id > 0){
                echo "actualiza";
//hay algo que hace que desaparesca el numero de serie
                $equiposTemporales = $this->modelequipo->getporInventarioEID(             $Inventarioequipos->Id);//las operaciones que ya peretenecen pongo
                $lastIdInventarioEquipos = $this->model->Actualizar(                 $Inventarioequipos); 
                
                $tamDT =count($equiposTemporales);
                echo "el contador $contador";
                echo "la cantidad $tamDT despues";
                //$tp1= var_dump($detalleequipotmp[0][1]);
                //echo "lo que esta comparando $tp1 des" ;

                for ($i=0; $i < $contador; $i++) {  
                //actualizar los detalles que ya estan en la base de datos
                for ($j=0; $j < $tamDT; $j++) { 
                    if ($detalleequipotmp[$i][1] == $equiposTemporales[$j][0]){
                        $equipo = new Equipos();
                        $equipo->Descripcion = $detalleequipotmp[$i][0];
                        $equipo->Id = $detalleequipotmp[$i][1];
                        $equipo->Marca = $detalleequipotmp[$i][2];
                        $equipo->Modelo = $detalleequipotmp[$i][3];
                        $equipo->NumeroSerie = $detalleequipotmp[$i][4];
                        $equipo->Fecha_Fabricacion= $detalleequipotmp[$i][5];
                        $equipo->InventarioEquipo_Id =$id_inventarioequipo ;
                         echo "llega acas";
                        $this->modelequipo->Actualizar($equipo);
                        unset($detalleequipotmp[$i]); //Eliminar de los nuevos detalles
                        unset($equiposTemporales[$j]);
                        $equiposTemporales = array_values($detallesTemporales);
                        break;
                    }
                } 
                    $tamDT =count($equiposTemporales);
                }


                for ($i=0; $i < count($equiposTemporales); $i++) { 
                    $this->modelequipo->Eliminar($equiposTemporales[$i][0]);    
                }

                echo "el contador $contador";
                $canti = count($detalleequipotmp);
                echo "+antes de insertar";
                $detalleequipotmp = array_values($detalleequipotmp);
                echo "la cantidad hay $canti";
                $prueba1 = var_dump($detalleequipotmp[0][4]);
                echo "esto es nulo  $prueba1 despues ";
                for ($i=0; $i <$canti ; $i++) { 
                    $equipo = new Equipos();
                    $equipo->Descripcion = $detalleequipotmp[$i][0];
                    $equipo->Id = $detalleequipotmp[$i][1];
                    $equipo->Marca = $detalleequipotmp[$i][2];
                    $equipo->Modelo =$detalleequipotmp[$i][3];//esto estaba mal
                    //$año =floatval($detallestemp[$i][4]);
                    $equipo->Numero_Serie =$detalleequipotmp[$i][4];                  
                    $equipo->Fecha_Fabricacion  = $detalleequipotmp[$i][5];                    
                    $equipo->InventarioEquipo_Id = $id_inventarioequipo;
                    $this->modelequipo->Registrar($equipo);
                }
            }
            else
            {
                $lastIdInventarioEquipos= $this->model->Registrar($Inventarioequipos);
                $numero = count($detalleequipotmp);
                for ($i=0; $i < $numero; $i++) { 
                    $equipo = new Equipos();
                    $equipo->Descripcion = $detalleequipotmp[$i][0];
                    $equipo->Id = $detalleequipotmp[$i][1];
                    $equipo->Marca = $detalleequipotmp[$i][2];
                    $equipo->Modelo =$detalleequipotmp[$i][3];
                    $equipo->Numero_Serie =$detalleequipotmp[$i][4];
                    $equipo->Fecha_Fabricacion =$detalleequipotmp[$i][5];
                    $equipo->InventarioEquipo_Id =$lastIdInventarioEquipos;
                    $this->modelequipo->Registrar($equipo);
                } 

            }

            header('Location:'.BASE_URL.'Inventarioequipos');
        }

        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Inventarioequipos');
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Inventarioequipos/pagination.php';
        }        

    }
?>