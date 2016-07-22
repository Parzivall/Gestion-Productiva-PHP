<?php foreach($this->model->Listar($startFrom) as $r): ?>
    <tr>
        <td><?php echo $r->Dni; ?></td>
        <td><?php echo $r->Username; ?></td>
        <td><?php echo $r->Nombres; ?></td>
        <td><?php echo $r->Apellidos; ?></td>
        <td><?php echo $r->Direccion; ?></td>
        <td><?php echo $r->Telefono; ?></td>
        <!--<td><?php echo $r->Email; ?></td>-->
        <!--<td><?php echo $r->Web; ?></td>-->
        <td><?php echo $r->Nacimiento; ?></td>
        <td><?php echo $r->Genero == 1 ? 'Hombre' : 'Mujer'; ?></td>

        <td class="cell-actions">
            <div class="btn-group">
                <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Personas/Crud/<?php echo $r->Dni; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Personas/Eliminar/<?php echo $r->Dni; ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>