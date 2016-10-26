<?php foreach((isset($_SESSION['Unidad_Id']) ? $this->model->getCronogramasByUnidadId($_SESSION['Unidad_Id'], $startFrom) : $this->model->Listar($startFrom)) as $r): ?>
    <tr>
        <td><?php echo $this->model->getUnidadById($r->Unidad_Id); ?></td>
        <td><?php echo $r->Descripcion ?></td>
        <td>
            <label class="checkbox">
                <input type="checkbox" disabled data-toggle="checkbox" <?php echo $r->Cumplido ? 'checked' : "" ?>>
            </label>
        </td>
        <td><?php echo $r->FechaInicio; ?></td>
        <td><?php echo $r->FechaFin; ?></td>

        <td class="cell-actions">
            <div class="btn-group">
                <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Cronogramas/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Cronogramas/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>