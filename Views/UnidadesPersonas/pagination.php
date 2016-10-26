<?php foreach((isset($_SESSION['Unidad_Id']) ? $this->model->getUnidadesPersonasByUnidadId($_SESSION['Unidad_Id'], $startFrom) : $this->model->Listar($startFrom)) as $r): ?>                                    
    <tr>
        <td><?php echo $r->Id; ?></td>
        <td><?php echo $this->model->getUnidadById($r->Unidad_Id); ?></td>
        <td><?php echo $this->model->getResponsableByDni($r->Persona_Dni); ?></td>
        <td><?php echo $this->model->getCargoById($r->Cargo_Id); ?></td>

        <td class="cell-actions">
            <div class="btn-group">
                <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>UnidadesPersonas/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>UnidadesPersonas/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>