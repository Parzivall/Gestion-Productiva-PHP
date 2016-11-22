<?php foreach($this->model->Buscar($startFrom, $search) as $r): ?>
    <tr>
        <td><?php echo $r->Descripcion; ?></td>
        <td><?php echo $this->modelTipoDocumento->Obtener($r->Tipo_Documento_Id)->Descripcion; ?></td>
        <td><?php echo $r->Numero; ?></td>
        <td><?php echo $r->Fecha_Legalizacion; ?></td>
        <td><?php echo $r->Numero_Folios; ?></td>
        <td><?php echo $r->EstadoOperativo; ?></td>
        <td><?php echo $r->Observaciones; ?></td>
        <td><?php echo $this->modelUnidadProductiva->Obtener($->Unidad_Id)->Nombre; ?></td>

        <td class="cell-actions">
            <div class="btn-group">
                <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Documentos/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Documentos/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>