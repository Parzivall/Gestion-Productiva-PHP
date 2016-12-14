<script type="text/javascript" src="<?php echo BASE_URL;?>Assets/js/jspdf.min.js"></script>

<script type="text/javascript">
var cantidadAcumulada = 0;
var editandoDetalle =false;
var rowEdit=null;
var tdId_insumo22='';
var tdCantidad=0;

var verificarRequeridos = function(){
        if ($('#Idmaterial').val()=='' || $('#Descripcion').val()==''){
            return false;
        }
        return true;
    }

var saveEditDetalle = function(parent){
        
        var tipomaterial = $('#Idmaterial').val()
        var descripcion = $('#Descripcion').val();
        var id = $('#Id').val();

    
</script>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="card">
				<ol class="breadcrumb">
					<li> <a href="<?php echo BASE_URL;?>InventarioBienes/"> 
						Inventario de Bienes </a>
						</li>
					<li class="active"><?php echo $Inventariobienes->Id != null ? $Inventariobienes ->Fecha_Ingreso : 'Nuevo Registro'; ?></li>
				</ol>

				<div class="content">
					<div class="row">
						<div class="col-md-6">
							<h4 class="title">
								<?php echo $Inventariobienes->Id!=null ? 'Inventario de Bienes':'Nuevo Registro: Inventario de Bienes'; ?>
							</h4>    
						</div>
					</div>
				</div>
				<ul style="text-align:left ; ">
                            <li> <A href="#agregarbien"> <h5> Nuevo bien </h5> </A> </li> <!--es necesario el numeral <LI> <LI>-->
                </ul>

				<div class="content crud">
					<form method="post" action="<?php echo BASE_URL;?>InventarioBienes/Guardar/" enctype="multipart/form-date">
						<div class="row">
							<div class="form-group">
								<div class="col-md-6">
									<input type="hidden" name="Id" value ="<?php echo $Inventariobienes->Id;?>" 	/>
									<label class="text-danger"> Fecha de Ingreso(*) 	</label>
									<input type="date" class="form-control" placeholder="fecha" name="Fecha_Ingreso" value="<?php echo $Inventariobienes->Fecha_Ingreso;?>" required>
								</div>
								<div class="col-md-6">
									<label class="text"> Cantidad 	</label>
									<input type="number" min="0" class="form-control" placeholder="" name="Cantidad" value="<?php echo $Inventariobienes->Cantidad;?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6"> 
							<label class="text"> Estado	</label>
							<select name="Estado" class="form-control">
													<option value="0"> malo</option>
													<option value="1"> regular</option>
													<option value="2"> bueno</option>
							</select>
							</div>
							<div class="col-md-6">
								<!-- <textarea form="a" name="a" cols="50" rows="2"></textarea> -->
								<label class="text"> Observaciones	</label>
								<input type="text" class="form-control" placeholder="Ingrese aqui" name="Observaciones" value="<?php echo $Inventariobienes->Observaciones;?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="text"> Estado Operativo </label>
								<select name="Operatividad" class="form-control">
														<option value="0"> no operativo</option>
														<option value="1"> operativo con reparaciones</option>
														<option value="2"> operativo</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="text"> Unidades Productivas </label>
								<select name="Unidad" class="form-control">
									<?php
                                    if (isset($_SESSION['Unidad_Id'])) {
                                        echo "<option selected value='".$_SESSION['Unidad_Id']."'>".$_SESSION['UnidadNombre']."2</option>";
                                    }
                                    else{?>
      									<?php foreach($this->model->getUnidades() as $r): ?>
										<option <?php echo ($Inventariobienes->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" > <?php echo $r->Nombre;?> </option>
										<?php endforeach; ?>
									<?php } 
										?>
								</select>
							</div>
						</div>

						<button type="submit" id="btnSubmit" class="btn btn-info btn-fill pull-right">Guardar</button>

						<div class=" card">
                            <div class="content">
                       		<a id ="agregarbien" > <h4 style ="text-align:center" ;> Nuevo Bien </h4> </a>
                       		<div class="row">

                       			<div class="col-md-5">
                       				<!--<div class="form-group">-->
                       				<label >Descripcion</label>
                       				<input type="text" id = "Descripcion" placeholder="dequetrata" class=" form-control">
                       				<!--</div>-->
                       			</div>
<!--me olvide no melo puedo creeer-->
                       			<div class="col-md-5">
                       				<label class="Tipo de Material"></label>
                       				<select class="form-control" name = "Idmaterial2" id="Idmaterial">
                       					<?php 
                       						foreach ($this->modeltipomaterial->Listar($startfrom ) as $r) {?>
                       							<option value="<?php echo $r->Id?>" />
                       								<?php echo $r->Descripcion;?>
                       							</option>
                       					<?php
                       						}
                       					?>
                       				</select>
                       			</div>

                       		</div>

                       		<div class="row">
                       			
                       		</div>
                       		</div>
                       	</div>

					</form>
				</div>					
			</div>
		</div>
	</div>
</div>
