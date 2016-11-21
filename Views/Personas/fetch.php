 <?php 
 $found = false;
 $output = '<div class="content table-responsive table-full-width">
              <table id="tablePersonas" class="table table-hover table-striped">
                  <thead>
                      <th>Dni</th>
                      <th>Usuario</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Nacimiento</th>
                      <th>Sexo</th>
                      <th></th>
                  </thead>
                  <tbody id="target-content">';
 foreach($this->model->Buscar($startFrom,$search) as $r):
    $found = true;
        $output .= '<tr>
                      <td>'.$r->Dni.'</td>
                      <td>'.$r->Username.'</td>
                      <td>'.$r->Nombres.'</td>
                      <td>'.$r->Apellidos.'</td>
                      <td>'.$r->Direccion.'</td>
                      <td>'.$r->Telefono.'</td>
                      <td>'.$r->Nacimiento.'</td>
                      <td>'.($r->Genero == 1 ? 'Hombre' : 'Mujer').'</td>
                      <td class="cell-actions">
                          <div class="btn-group">
                              <a class="btn btn-xs btn-warning buttonCrud" href="'.BASE_URL.'Personas/Crud/'.$r->Dni.'"'.'><span class="glyphicon glyphicon-pencil"></span></a>
                              <a onclick="javascript:return confirm('."'¿Seguro de eliminar este registro?'".');"'.'class="btn btn-xs btn-danger buttonCrud" href="'.BASE_URL.'Personas/Eliminar/'.$r->Dni.'"><span class="glyphicon glyphicon-trash"></span></a>
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
                    $output.= '<li class="active"  id="'.$i.'"><a href="'.BASE_URL.'Personas/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>'; 
                  else:
                    $output.= '<li id="'.$i.'"><a href="'.BASE_URL.'Personas/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>';
                  endif;
                endfor;endif;
            $output.= '</ul></nav>';
            $output.= '<input type="text" id="totalRecords" value="'.$totalRecords.'">';

if (!$found)
{
  echo 'No se encontraron coincidencias';
} else 
{
  echo $output;
}
?>
