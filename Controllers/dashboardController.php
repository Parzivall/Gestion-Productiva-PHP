<?php

require_once("Core/Session.php");
require_once 'Models/DocumentoModel.php';
require_once 'Models/TipoComprobantePagoModel.php';
require_once 'Models/UnidadProductivaModel.php';
require_once 'Models/PersonaModel.php';
require_once 'Models/CargoModel.php';
require_once 'Models/OperacionModel.php';

class DashboardController{
    
    private $modelDocumento;
    private $modelTipoDocumento;
    private $modelUnidadProductiva;
    private $modelOperacion;
    private $documento;
    private $dashboard;
    
    public function __construct(){
        $dashboard = new Documento();
        $this->modelDocumento = new Documento();
        $this->modelTipoDocumento = new TipoComprobantePago();
        $this->modelUnidadProductiva = new UnidadProductiva();
    }
    
    public function Index(){
        $dashboard = new Documento();
        require_once 'Views/header.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/panel.php';
        require_once 'Views/Dashboard/index.php';
        require_once 'Views/footer.php';
    }

    public function Ingresos()
    {
        require_once 'Views/Dashboard/ingresos.php';
    }

    public function Egresos()
    {
        require_once 'Views/Dashboard/egresos.php';
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