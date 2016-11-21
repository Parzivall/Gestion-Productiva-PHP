<?php

require_once("Core/Session.php");
require_once 'Models/PersonaModel.php';

class PersonasController{
    
    private $model;
    private $persona;
    
    public function __construct(){
        $this->model = new Persona();

    }
    
    public function Index(){
        $persona = new Persona();
        $totalRecords = $this->model->getTotalRecords();
        $totalPages = ceil($totalRecords/resultsPerPage);
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;
        require_once 'Views/header.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/panel.php';
        require_once 'Views/Personas/index.php';
        require_once 'Views/footer.php';
    }
    
    public function Crud(){
        $persona = new Persona();
        $totalRecords = $this->model->getTotalRecords();
        $totalPages = ceil($totalRecords/resultsPerPage);
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;

        if(isset($_REQUEST['Dni'])){
            $persona = $this->model->Obtener($_REQUEST['Dni']);
        }
        require_once 'Views/header.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/panel.php';
        require_once 'Views/Personas/update.php';
        require_once 'Views/footer.php';
    }

    public function Pagination(){
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;
        require_once 'Views/Personas/pagination.php';
    }

    public function Paginacion(){
        if (isset($_GET["search"])) { $search  = $_GET["search"]; } else { $search=''; };  
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;
        require_once 'Views/Personas/paginationsearch.php';
    }

    public function Verificar(){
        require_once 'Views/Personas/check_availability.php';
    }

    public function Buscar(){
        $search = '';
        $persona = new Persona();
        if (isset($_POST["search"])) { $search  = $_POST["search"]; } else { $search=''; };  
        $totalRecords = $this->model->getTotalRecordsBusqueda($search);
        $totalPages = ceil($totalRecords/resultsPerPage);
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
        $startFrom = ($page-1) * resultsPerPage;
        require_once 'Views/Personas/fetch.php';
    }
    
    public function Guardar(){
        $persona = new Persona();

        if($_FILES["Foto"]["error"] == 4) {
            //means there is no file uploaded
        }
        else{
            $path = $_FILES['Foto']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $imagePath = 'imagenes/personas/'.$_REQUEST['DniUpdate'].'.'.$ext;
            $persona->Foto = $imagePath;
            /*
            if (getimagesize($_FILES['Foto']['tmp_name'])!=FALSE){
                $foto= addslashes($_FILES['Foto']['tmp_name']);
                $name= addslashes($_FILES['Foto']['name']);
                $foto= file_get_contents($foto);
                $foto= base64_encode($foto);
                $persona->Foto = $foto;    
            } 
            */   
        }
        $DniUpdate = $_REQUEST['DniUpdate'];
        $persona->Dni = $_REQUEST['Dni'];
        $persona->Username = $_REQUEST['Username'];
        $persona->Password = $_REQUEST['Password'];
        $persona->Nombres = $_REQUEST['Nombres'];
        $persona->Apellidos = $_REQUEST['Apellidos'];
        $persona->Direccion = $_REQUEST['Direccion'];
        $persona->Telefono = $_REQUEST['Telefono'];
        $persona->Email = $_REQUEST['Email'];
        $persona->Web = $_REQUEST['Web'];
        $persona->Nacimiento = $_REQUEST['Nacimiento'];
        $persona->Genero = $_REQUEST['Genero'];        
        $persona->Informacion = $_REQUEST['Informacion'];
        $persona->Fecha_Ingreso = $_REQUEST['FechaIngreso'];
        $persona->Condicion_Laboral = $_REQUEST['CondicionLaboral'];
        $persona->Especialidad = $_REQUEST['Especialidad'];
        $persona->Cargo_Id = $_REQUEST['Cargo'];
        $persona->Unidad_Id = $_REQUEST['Unidad'];

        if ($DniUpdate!="-1"){
            $persona->Dni = $_REQUEST['DniUpdate'];
            $this->model->Actualizar($persona);
        }else{
            $this->model->Registrar($persona);
        }
        
        header('Location:'.BASE_URL.'Personas');
    }
    
    public function Eliminar(){
        if (!$this->model->Eliminar($_REQUEST['Dni']))
        {
            $persona = new Persona();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Personas/index.php';
            require_once 'Views/footer.php';
            $unidadResponsable = $this->model->getUnidadById($this->model->Obtener($_REQUEST['Dni'])->Unidad_Id);
            echo '<script type="text/javascript">'.'demo.showDangerNotification("top","center",'.'"La persona que intenta eliminar es actualmente responsable de la unidad '.$unidadResponsable.', asigne otro responsable a dicha unidad para poder eliminar esta persona."); </script>';
            /*echo '<script type="text/javascript">',
                 "$.notify({",
                    "icon: 'pe-7s-info',",
                    "message: 'Hoy es el ultimo dia para cumplir'",
                 "},{",
                    "type: 'danger',",
                    "timer: 4000,",
                    " placement :{",
                        "from : 'top'",
                        "align: 'center'",
                    "}",
                  "});",
                 '</script>';
                 */
            //header('Location:'.BASE_URL.'Personas');       
        }
        else
        {
            header('Location:'.BASE_URL.'Personas');    
        }
    }
}