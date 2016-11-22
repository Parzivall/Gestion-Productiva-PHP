 <?php 
 $found = false;
 $output = '<div class="content table-responsive table-full-width">
              <table id="tableDocumentos" class="table table-hover table-striped">
                  <thead>
                      <th>Descripcion</th>
                      <th>Tipo de Documento</th>
                      <th>N° de Documento</th>
                      <th>Fecha Legalización</th>
                      <th>N° de Folios</th>
                      <th>Estado Operativo</th>
                      <th>Observaciones</th>
                      <th></th>
                  </thead>
                  <tbody id="target-content">';
 foreach($this->model->Buscar($startFrom,$search) as $r):
    $found = true;
        $output .= '<tr>
                      <td>'.$r->Descripcion.'</td>
                      <td>'.$this->modelTipoDocumento->Obtener($r->Tipo_Documento_Id)->Descripcion.'</td>
                      <td>'.$r->Numero.'</td>
                      <td>'.$r->Fecha_Legalizacion.'</td>
                      <td>'.$r->Numero_Folios.'</td>
                      <td>'.$r->EstadoOperativo.'</td>
                      <td>'.$r->Observaciones.'</td>
                      <td>'.$this->modelUnidadProductiva->Obtener($r->Unidad_Id)->Nombre.'</td>
                      <td class="cell-actions">
                          <div class="btn-group">
                              <a class="btn btn-xs btn-warning buttonCrud" href="'.BASE_URL.'Documentos/Crud/'.$r->Id.'"'.'><span class="glyphicon glyphicon-pencil"></span></a>
                              <a onclick="javascript:return confirm('."'¿Seguro de eliminar este registro?'".');"'.'class="btn btn-xs btn-danger buttonCrud" href="'.BASE_URL.'Documentos/Eliminar/'.$r->Id.'"><span class="glyphicon glyphicon-trash"></span></a>
                          </div>
                      </td>
                    </tr>';
endforeach;
$output.=         '</tbody>
                </table>
            </div>
            <nav><ul class="pagination">';
                if(!empty($totalPages)):for($i=1; $i<=$totalPages; $i++):  
                  if($i == 1):
                    $output.= '<li class="active"  id="'.$i.'"><a href="'.BASE_URL.'Documentos/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>'; 
                  else:
                    $output.= '<li id="'.$i.'"><a href="'.BASE_URL.'Documentos/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>';
                  endif;
                endfor;endif;
            $output.= '</ul></nav>';
            $output.= '<input hidden type="text" id="totalRecords" value="'.$totalRecords.'">';
            $output.= '<p class="text-success"> Total: '.$totalRecords.'</p>';

if (!$found)
{
  echo 'No se encontraron coincidencias';
} else 
{
  echo $output;
}
?>
