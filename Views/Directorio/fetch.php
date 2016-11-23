 <?php 
 $found = false;
 $output = '<div class="content table-responsive table-full-width">
                <table id="tableDirectorio" class="table table-hover table-striped">
                    <thead>
                        <th>Id</th>                                        
                        <th>Nombre</th>
                        <th>Rubro</th>
                        <th>Web</th>
                        <th>Telefono</th>
                        <th>Anexo</th>
                        <th>Celular</th>
                        <th>Ubicacion</th>
                        <th>Ciudad</th>
                        <th>Responsable</th>
                        <th></th>
                    </thead>
                    <tbody id="target-content">';
 foreach($this->model->Buscar($startFrom,$search) as $r):
    $found = true;
        $output .= '<tr>
                      <td>'.$r->Id.'</td>
                      <td>'.$r->Nombre.'</td>
                      <td>'.$this->model->getRubroById($r->Rubro_Id).'</td>
                      <td>'.$r->Web.'</td>
                      <td>'.(empty($r->Telefono) ? '' : $r->Telefono).'</td>
                      <td>'.(empty($r->Telefono_Anexo) ? ' ' : $r->Telefono_Anexo).'</td>
                      <td>'.(empty($r->Celular) ? ' ' : $r->Celular).'</td>
                      <td>'.$r->Ubicacion.'</td>
                      <td>'.$this->model->getCiudadById($r->Ciudad_Id).'</td>
                      <td>'.$this->model->getResponsableByDni($r->Persona_Dni).'</td>
                    </tr>';
endforeach;
$output.=         '</tbody>
                </table>
            </div>

            <nav><ul class="pagination">';
                if(!empty($totalPages)):for($i=1; $i<=$totalPages; $i++):  
                  if($i == 1):
                    $output.= '<li class="active"  id="'.$i.'"><a href="'.BASE_URL.'Directorio/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>'; 
                  else:
                    $output.= '<li id="'.$i.'"><a href="'.BASE_URL.'Directorio/Paginacion/Pagina/'.$i.'/Busqueda/'.$search.'">'.$i.'</a></li>';
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
