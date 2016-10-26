<?php
    require_once("Core/Session.php");
    require_once 'Models/UnidadProductivaModel.php';

    if ($_SESSION['TipoUsuario']==0){
        header('Location:'.BASE_URL.'Home');       
    }


    class UnidadesProductivasController{
        
        private $model;
        private $unidad;
        
        public function __construct(){
            $this->model = new UnidadProductiva();
        }
        
        public function Index(){
            $unidad = new UnidadProductiva();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/UnidadesProductivas/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $unidad = new UnidadProductiva();
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
            require_once 'Views/UnidadesProductivas/update.php';
            require_once 'Views/footer.php';
        }

        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/UnidadesProductivas/pagination.php';
        }
        
        public function Verificar(){
            require_once 'Views/UnidadesProductivas/check_availability.php';
        }

        public function Guardar(){
            //Manejar imagen organigrama
            $unidad = new UnidadProductiva();

            if($_FILES["Organigrama"]["error"] == 4) {
                //means there is no file uploaded
            }
            else{
                if (getimagesize($_FILES['Organigrama']['tmp_name'])!=FALSE){
                    $organigrama= addslashes($_FILES['Organigrama']['tmp_name']);
                    $name= addslashes($_FILES['Organigrama']['name']);
                    $organigrama= file_get_contents($organigrama);
                    $organigrama= base64_encode($organigrama);
                    $unidad->Organigrama = $organigrama;    
                }    
            }
            
            $unidad->Id = $_REQUEST['Id'];
            $unidad->Nombre = $_REQUEST['Nombre'];
            $unidad->Rubro_Id = $_REQUEST['Rubro'];
            $unidad->Web = $_REQUEST['Web'];
            $unidad->Telefono = $_REQUEST['Telefono'];
            $unidad->Telefono_Anexo = $_REQUEST['Telefono_Anexo'];
            $unidad->Fax = $_REQUEST['Fax'];
            $unidad->Celular = $_REQUEST['Celular'];
            $unidad->Ubicacion = $_REQUEST['Ubicacion'];
            $unidad->Ciudad_Id = $_REQUEST['Ciudad'];

            if ($_REQUEST['Responsable'] === '') {
                $unidad->Persona_Dni = null; // or 'NULL' for SQL
            }
            else
            {
                $unidad->Persona_Dni = $_REQUEST['Responsable'];    
            }

            

            $unidad->Id > 0 
                ? $this->model->Actualizar($unidad)
                : $this->model->Registrar($unidad);
            
            header('Location:'.BASE_URL.'UnidadesProductivas');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'UnidadesProductivas');
        }
    }
?>