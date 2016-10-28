<?php foreach($this->model->Listar($startFrom) as $r): ?>
    <tr>
        <td><?php echo $r->Nombre; ?></td>
        <td><?php echo $this->model->getRubroById($r->Rubro_Id); ?></td>
        <!--<td><?php echo $r->Web; ?></td>-->
        <td><?php echo $r->Telefono; ?></td>
        <!--<td><?php echo $r->Telefono_Anexo; ?></td>-->
        <!--<td><?php echo $r->Fax; ?></td>-->
        <td><?php echo $r->Celular; ?></td>
        <td><?php echo $r->Ubicacion;?></td>
        <td><?php echo $this->model->getCiudadById($r->Ciudad_Id); ?></td>

        <td class="cell-actions">
            <div class="btn-group">
                <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>UnidadesProductivas/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>UnidadesProductivas/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>