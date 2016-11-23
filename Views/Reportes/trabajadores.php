<?php 
	require_once('Core/pdf/mpdf.php');

  global $modelPersona;
  global $modelCargo;
  global $modelUnidadProductiva;
  $modelPersona = new Persona();
  $modelCargo = new Cargo();
  $modelUnidadProductiva = new UnidadProductiva();
  global $unidad;
  global $responsable;
  global $nombreUnidad;
  $unidad = $this->modelUnidadProductiva->Obtener($_GET['Unidad']);
  $responsable = $this->modelUnidadProductiva->getResponsableByDni($unidad->Persona_Dni);
  $nombreUnidad = $unidad->Nombre;

  global $condicionLaboral;

  $condicionLaboral = array('ACTIVO O SUBSIDIADO', 'BAJA', 'SUSPENSIÓN PERFECTA', 'SIN VÍNCULO LABORAL CON CONCEPTOS PENDIENTE DE LIQUIDAR');


  function mostrarDocumento()
  {

    global $modelPersona, $modelCargo, $modelUnidadProductiva, $unidad, $responsable, $nombreUnidad, $condicionLaboral;
    $output = '<thead>
                <tr>
                  <th>APELLIDOS Y NOMBRES</th>
                  <th>N° DNI</th>
                  <th>FECHA DE INGRESO</th>
                  <th>ESPECIALIDAD</th>
                  <th>CONDICION LABORAL</th>
                  <th>CARGO</th>
                  <th>GRADOS/TITULOS OTROS</th>
                  <th>TELEFONO</th>
                </tr>
            </thead>
            <tbody>';

      foreach($modelPersona->getAllByUnidadId($unidad->Id) as $r):
        $found = true;
        $output .= '<tr>
                      <td>'.$r->Apellidos.' '.$r->Nombres.'</td>
                      <td>'.$r->Dni.'</td>
                      <td>'.$r->Fecha_Ingreso.'</td>
                      <td>'.$r->Especialidad.'</td>
                      <td>'.$condicionLaboral[intval($r->Condicion_Laboral)-1].'</td>
                      <td>'.$modelCargo->Obtener($r->Cargo_Id)->Descripcion.'</td>
                      <td>'.''.'</td>
                      <td>'.(empty($r->Telefono) ? 'NO TIENE' : $r->Telefono).'</td>
                    </tr>';
    endforeach;
    $output.= '</tbody>';

    $html = '<div style="border:1px solid black;"> <header>
        <h1>'.UNIVERSIDAD.'</h1>
        <h2>RELACIÓN DE TRABAJADORES</h2>
        <div id="project">

          <table class="tableHeaderReport">
            
              <tr>
                <td><div><span>CENTRO DE PRODUCCIÓN: </span> '.$nombreUnidad.'</div></td>
                <td><div><span>JEFE ENCARGADO: </span> '.$responsable.'</div></td>
              </tr>
              
              <tr>
                <td><div><span>FACULTAD Y/O DEPENDENCIA: </span> '.' '.'</div></td>
              </tr>
              
              <!--
              <tr>
                <td><div><span>PERIODO :</span> --- </div></td>
                <td><div><span>DIRECCIÓN: </span> '.$unidad->Ubicacion.'</div></td>
              -->
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