 <?php foreach($this->model->Listar($startFrom) as $r): ?>
    <tr>
        <td><?php echo $r->Id; ?></td>
        <td><?php echo $r->Nombre; ?></td>
        <td><?php echo $this->model->getRubroById($r->Rubro_Id); ?></td>
        <td><?php echo $r->Web; ?></td>
        <td><?php echo $r->Telefono; ?></td>
        <td><?php echo $r->Telefono_Anexo; ?></td>
        <td><?php echo $r->Celular; ?></td>
        <td><?php echo $r->Ubicacion; ?></td>
        <td><?php echo $this->model->getCiudadById($r->Ciudad_Id); ?></td>
        <td><?php echo $this->model->getResponsableByDni($r->Persona_Dni); ?></td>
    </tr>
<?php endforeach; ?>