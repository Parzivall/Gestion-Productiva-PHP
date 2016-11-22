<?php
    require_once("Core/Session.php");
    require_once 'Models/DocumentoModel.php';
    require_once 'Models/TipoComprobantePagoModel.php';
    require_once 'Models/UnidadProductivaModel.php';

    class DocumentosController{
        
        private $model;
        private $modelTipoDocumento;
        private $modelUnidadProductiva;
        private $documento;
        
        public function __construct(){
            $this->model = new Documento();
            $this->modelTipoDocumento = new TipoComprobantePago();
            $this->modelUnidadProductiva = new UnidadProductiva();
        }
        
        public function Index(){
            $documento = new Documento();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Documentos/index.php';
            require_once 'Views/footer.php';
        }
        
        public function Crud(){
            $documento = new Documento();
            $totalRecords = $this->model->getTotalRecords();
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;

            if(isset($_REQUEST['Id'])){
                $documento = $this->model->Obtener($_REQUEST['Id']);
            }
            
            require_once 'Views/header.php';
            require_once 'Views/sidebar.php';
            require_once 'Views/panel.php';
            require_once 'Views/Documentos/update.php';
            require_once 'Views/footer.php';
        }

        /*
        public function Pagination(){
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Documentos/pagination.php';
        }
        */

        public function Paginacion(){
            if (isset($_GET["search"])) { $search  = $_GET["search"]; } else { $search=''; };  
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Documentos/paginationsearch.php';
        }

        public function Buscar(){
            $search = '';
            $documento = new Documento();
            if (isset($_POST["search"])) { $search  = $_POST["search"]; } else { $search=''; };  
            $totalRecords = $this->model->getTotalRecordsBusqueda($search);
            $totalPages = ceil($totalRecords/resultsPerPage);
            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
            $startFrom = ($page-1) * resultsPerPage;
            require_once 'Views/Documentos/fetch.php';
        }
        
        public function Verificar(){
            require_once 'Views/Documentos/check_availability.php';
        }

        public function Guardar(){
            //Manejar imagen organigrama
            $documento = new Documento();
            
            $documento->Id = $_REQUEST['Id'];
            $documento->Descripcion = $_REQUEST['Descripcion'];
            $documento->Tipo_Documento_Id = $_REQUEST['Tipo_Documento'];
            $documento->Numero = $_REQUEST['Numero_Documento'];
            $documento->Fecha_Legalizacion = $_REQUEST['Fecha_Legalizacion'];
            $documento->Numero_Folios = $_REQUEST['Numero_Folios'];
            $documento->EstadoOperativo = $_REQUEST['EstadoOperativo'];
            $documento->Observaciones = $_REQUEST['Observaciones'];
            $documento->Unidad_Id = $_REQUEST['Unidad'];    
            $documento->Id > 0 
                ? $this->model->Actualizar($documento)
                : $this->model->Registrar($documento);
            
            header('Location:'.BASE_URL.'Documentos');
        }
        
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['Id']);
            header('Location:'.BASE_URL.'Documentos');
        }
    }
?>