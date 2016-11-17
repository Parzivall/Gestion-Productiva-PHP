<?php foreach((isset($_SESSION['Unidad_Id']) ? $this->model->getOperacionesByUnidadId($_SESSION['Unidad_Id'], $startFrom) : $this->model->Listar($startFrom)) as $r): ?>
    <tr>
        <td><?php echo $r->Tipo==1 ? "Ingreso" : "Egreso" ; ?></td>
        <td><?php echo "S/.".($this->model->getMontoTotal($r->Id)=='' ? "0" : $this->model->getMontoTotal($r->Id)); ?></td>
        <td><?php echo $this->model->getUnidadById($r->Unidad_Id); ?></td>
        <td><?php echo $r->Fecha; ?></td>
        <td class="cell-actions">
            <div class="btn-group">
                <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Operaciones/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Operaciones/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>