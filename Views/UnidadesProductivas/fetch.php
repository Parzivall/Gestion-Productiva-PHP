 <?php 
 $found = false;
 $output = '<div class="content table-responsive table-full-width">
                <table id="tableUnidades" class="table table-hover table-striped">
                    <thead>
                        <th>Nombre</th>
                        <th>Rubro</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Ubicacion</th>
                        <th>Ciudad</th>
                        <th></th>
                    </thead>
                    <tbody id="target-content">';
 foreach($this->model->Buscar($startFrom,$search) as $r):
    $found = true;
        $output .= '<tr>
                      <td>'.$r->Nombre.'</td>
                      <td>'.$this->model->getRubroById($r->Rubro_Id).'</td>
                      <td>'.$r->Telefono.'</td>
                      <td>'.$r->Celular.'</td>
                      <td>'.$r->Ubicacion.'</td>
                      <td>'.$this->model->getCiudadById($r->Ciudad_Id).'</td>
                      <td class="cell-actions">
                          <div class="btn-group">
                              <a class="btn btn-xs btn-warning buttonCrud" href="'.BASE_URL.'UnidadesProductivas/Crud/'.$r->Id.'"'.'><span class="glyphicon glyphicon-pencil"></span></a>
                              <a onclick="javascript:return confirm('."'¿Seguro de eliminar este registro?'".');"'.'class="btn btn-xs btn-danger buttonCrud" href="'.BASE_URL.'UnidadesProductivas/Eliminar/'.$r->Id.'"><span class="glyphicon glyphicon-trash"></span></a>
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
                    $output.= '<li class="active"  id="'.$i.'"><a href="'.BASE_URL.'UnidadesProductivas/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>'; 
                  else:
                    $output.= '<li id="'.$i.'"><a href="'.BASE_URL.'UnidadesProductivas/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>';
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
