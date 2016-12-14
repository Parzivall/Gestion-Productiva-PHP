<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="content">
						<form method="post" action="<?php echo BASE_URL;?>InventarioBienes/crud">
							<div class="row"> 
								<div class="col-md-4">
									<h4 class="title"> Inventarios:</h4>
								</div>
								<div class="col-md-8">
									<select class="form-control" name="Tables" id="Tables" onchange="location=this.value;">
										<option value="<?php echo BASE_URL;?>InventarioBienes" <?php if(isset($this->auxTable) && $this->auxTable=="InventarioBienes")echo 'selected';?> > Inventario de Bienes </option>
										<option value="<?php echo BASE_URL;?>InventarioEquipos" <?php if(isset($this->auxTable) && $this->auxTable=="InventarioEquipos")echo 'selected';?> > Inventario de Equipos </option>
										<option value="<?php echo BASE_URL;?>InventarioFisico" <?php if(isset($this->auxTable) && $this->auxTable=="InventarioFisico")echo 'selected';?> > Inventario Fisico </option>
									</select>
								</div>
								<div>
									<div class="col-md-2"></div>
									<div class="col-md-4"> <h4>Inventario de Bienes</h4> </div>
								</div>
								<div  class="col-md-2">
         <button type="submit" class="btn btn-info btn-fill pull-right">Agregar Inventario</button>
        </div>
        <div class="row" style="margin-left: 10%; margin-right: 10">
        	<div class="col-md-12">
        		<div class="input-group">
        			<input type="text" id="search" class="search-query form-control" placeholder="Ej: Descripcion">
        			<div class="input-group-addon"> <span class="glyphicon glyphicon-search"></span> </div>
        		</div>
        	</div>
        </div>
        <div class="content table-responsive table-full-width">
        	<table id=tableBienes class="table table-hover table-striped">
        		<thead>
        			<th>Fecha Ingreso </th>
        			<th>Unidad Productiva </th>
        			<th>Condicion </th>
        			<th>Estado Operativo</th>
        			<th>Observaciones</th>
        		</thead>
        		<tbody id="target-content">
        			<?php foreach ($this->model->Listar($startFrom) as $r): ?>
                        <?php
                        if (isset($_SESSION['Unidad_Id']) ) {
                            $unidadid=$_SESSION['Unidad_Id'];
                            //$idequipo = $this->model->getInventarioId($unidadid);
                            //aca faltaria la unidad productiva
                        ?>
                        <?php
                            if( $r->Unidad_Id == $unidadid)
                            {?>
                            <td><?php echo $r->Fecha_Ingreso; ?></td>
                            <td><?php echo $this->model->ObtenerNombreUnidadProductiva($r->Unidad_Id)->Nombre; ?></td>
                            <td><?php echo $r->Estado; ?></td>
                            <td><?php echo $r->EstadoOperativo; ?></td>
                            <td><?php echo $r->Observaciones; ?></td>
                                                        <td class=" cell-actions">
                 <div class="btn-group">
                  <a class="btn btn-xs btn-warning buttonCrud"    href="<?php echo BASE_URL;?>InventarioBienes/Crud/<?php echo $r->Id; ?> "><span class="glyphicon glyphicon-pencil"></span></a>
                  <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>InventarioBienes/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
                 </div>
            </td>
                            <?php
                            } 
                        }
                        else{?>                   
        				<tr>
        					<td><?php echo $r->Fecha_Ingreso; ?></td>
        					<td><?php echo $this->model->ObtenerNombreUnidadProductiva($r->Unidad_Id)->Nombre; ?></td>
        					<td><?php echo $r->Estado; ?></td>
        					<td><?php echo $r->EstadoOperativo; ?></td>
        					<td><?php echo $r->Observaciones; ?></td>
        					<td class=" cell-actions">
	             <div class="btn-group">
	              <a class="btn btn-xs btn-warning buttonCrud"    href="<?php echo BASE_URL;?>InventarioBienes/Crud/<?php echo $r->Id; ?> "><span class="glyphicon glyphicon-pencil"></span></a>
	              <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>InventarioBienes/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
	             </div>
            </td>	
        				</tr>
                        <?php
                        }
                        ?>
        				<?php endforeach; ?>
        		</tbody>
        	</table>
        </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>