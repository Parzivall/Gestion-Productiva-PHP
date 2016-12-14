<?php foreach($this->model->Listar($startFrom) as $r): ?>
    <tr>
        <td><?php echo $r->Descripcion_Existencia; ?></td>
        <td><?php echo $r->Periodo; ?></td>
        <?php $tp_array = $this->model->getDetalle_Cantidad($r->Id);  ?>
        <td><?php echo ( $tp_array['Cantidad'] == '') ? "0" : $tp_array['Cantidad'] ?></td>
        
        <td class="cell-actions">
            <div class="btn-group">
                <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>InventarioFisico/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>InventarioFisico/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>