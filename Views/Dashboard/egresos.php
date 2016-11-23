<?php

global $modelOperacion;
$modelOperacion = new Operacion();

if( isset($_GET['Unidad']) ) {
    getIngresos($_GET['Unidad']);
} else {
    die("Solicitud no válida.");
}

function getIngresos( $id ) {
    global $modelOperacion;
    
    $jsondata = $modelOperacion->getEgresosAgrupadosByUnidadId($id);
    $jsondata["success"] = true;
    
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);    
}

exit();                            