<?php 
	require_once('Core/pdf/mpdf.php');

  global $modelDocumento;
  global $modelTipoDocumento;
  global $modelUnidadProductiva;
  $modelDocumento = new Documento();
  $modelTipoDocumento = new TipoComprobantePago();
  $modelUnidadProductiva = new UnidadProductiva();
  global $unidad;
  global $responsable;
  global $nombreUnidad;
  $unidad = $this->modelUnidadProductiva->Obtener($_GET['Unidad']);
  $responsable = $this->modelUnidadProductiva->getResponsableByDni($unidad->Persona_Dni);
  $nombreUnidad = $unidad->Nombre;
  function mostrarDocumento()
  {

    global $modelDocumento, $modelTipoDocumento, $modelUnidadProductiva, $unidad, $responsable, $nombreUnidad;
    $output = '<thead>
                <tr>
                  <th>Descripcion</th>
                  <th>Tipo de Documento</th>
                  <th>N° de Documento</th>
                  <th>Fecha Legalización</th>
                  <th>N° de Folios</th>
                  <th>Estado Operativo</th>
                  <th>Observaciones</th>
                  <th>Unidad</th>
                </tr>
            </thead>
            <tbody>';

      foreach($modelDocumento->getAllByUnidadId($unidad->Id) as $r):
        $found = true;
        $output .= '<tr>
                      <td>'.$r->Descripcion.'</td>
                      <td>'.$modelTipoDocumento->Obtener($r->Tipo_Documento_Id)->Descripcion.'</td>
                      <td>'.$r->Numero.'</td>
                      <td>'.$r->Fecha_Legalizacion.'</td>
                      <td>'.$r->Numero_Folios.'</td>
                      <td>'.$r->EstadoOperativo.'</td>
                      <td>'.$r->Observaciones.'</td>
                      <td>'.$modelUnidadProductiva->Obtener($r->Unidad_Id)->Nombre.'</td>
                    </tr>';
    endforeach;
    $output.= '</tbody>';

    $html = '<div style="border:1px solid black;"> <header>
        <h1>'.UNIVERSIDAD.'</h1>
        <h2>INVENTARIO DE DOCUMENTOS EXISTENTES</h2>
        <div id="project">

          <table class="tableHeaderReport">
            
              <tr>
                <td><div><span>CENTRO DE PRODUCCIÓN: </span> '.$nombreUnidad.'</div></td>
                <td><div><span>RESPONSABLE: </span> '.$responsable.'</div></td>
              </tr>
              <!--
              <tr>
                <td><div><span>FACULTAD:</span> Website development</div></td>
                <td><div><span>ACTIVIDAD</span> John Doe</div></td>
              </tr>
              -->
              <tr>
                <td><div><span>PERIODO :</span> --- </div></td>
                <td><div><span>DIRECCIÓN: </span> '.$unidad->Ubicacion.'</div></td>
              </tr>          
          </table>
        </div>
      </header>
      <br>
      <main>
        <table border="1">'.$output.'</table>
      </main></div>';

    $mpdf = new mPdf('c', 'A4-L');
    $css = file_get_contents('Views/Reportes/css/style.css');
    $mpdf->writeHTML($css, 1);
    $mpdf->writeHTML($html);
    $mpdf->Output('reporte.pdf', 'I');
  }

  if (!isset($_SESSION['TipoUsuario']))
  {
    echo 'No tienes permisos para acceder al contenido, logeate primero';
  }
  else
  {
    if ($_SESSION['TipoUsuario']==0 )
    {
        if (isset($_SESSION['Unidad_Id'])) {
          if ($_SESSION['Unidad_Id'] == $_REQUEST['Unidad'])
          {
            mostrarDocumento();
          } else {
            echo "No tienes permisos para ver este documento";
          }
        } else {
          echo "No tienes permisos para acceder al contenido, logeate primero";
        }
    } else {
        mostrarDocumento();
    }
  }
?>