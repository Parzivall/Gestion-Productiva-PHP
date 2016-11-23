<?php

require_once("Core/Session.php");
require_once 'Models/DocumentoModel.php';
require_once 'Models/TipoComprobantePagoModel.php';
require_once 'Models/UnidadProductivaModel.php';
require_once 'Models/PersonaModel.php';
require_once 'Models/CargoModel.php';

class DashboardController{
    
    private $modelDocumento;
    private $modelTipoDocumento;
    private $modelUnidadProductiva;
    private $documento;
    
    public function __construct(){
        $this->modelDocumento = new Documento();
        $this->modelTipoDocumento = new TipoComprobantePago();
        $this->modelUnidadProductiva = new UnidadProductiva();
    }
    
    public function Index(){
        require_once 'Views/header.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/panel.php';
        require_once 'Views/Dashboard/index.php';
        require_once 'Views/footer.php';
    }

    public function ReporteDocumentos()
    {
        require_once 'Views/Reportes/documentos.php';
    }

    public function ReporteTrabajadores()
    {
        require_once 'Views/Reportes/trabajadores.php';
    }
}