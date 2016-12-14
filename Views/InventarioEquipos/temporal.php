<script type="text/javascript" src="<?php echo BASE_URL;?>Assets/js/jspdf.min.js"></script>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <ol class="breadcrumb">
                        <li> <a href="<?php echo BASE_URL;?>Inventarioequipos/"> 
                        Inventario de equipo </a>
                        </li>
                        <li class="active"><?php echo $Inventarioequipo->Id != null ? $Inventarioequipo ->EstadoOperativo : 'Nuevo Registro'; ?></li>
                    </ol>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">
                                    <?php echo $Inventarioequipo->Id!=null ? $Inventarioequipo->Fecha_Ingreso:'Nuevo Registro: Inventario de equipos'; ?>
                                </h4>    
                            </div>
                        </div>
                    </div>

                    <div class="content crud">
                        <form method="post" action="<?php echo BASE_URL;?>Inventarioequipos/Guardar/" enctype="multipart/form-data">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="Id" value="<?php echo $Inventarioequipo->Id; ?>" />

                                        <label class="text-danger">Fecha de Ingreso(*)</label>
                                        <!--onBlur="checkNameAvailability()" esto es un scripts + abajo-->
                                       <input type="date" class="form-control" placeholder="" name="Fecha_Ingreso"  value="<?php echo $Inventarioequipo->Fecha_Ingreso; ?>">
                                        <span id="name-availability-status"></span> 
                                        <!--css spam previamente definido-->
                                       <!-- <p><img src="<?php echo BASE_URL;?>Assets/img/LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>-->

                                    </div>
                                </div>  

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Condicion</label>
                                        
                                        <select name="Condicion" class="form-control">
                                                <option value="0"> Alquiler</option>
                                                <option value="1"> Propio</option>
                                        </select>

                                     </div>
                                </div>
    
                            </div>

                            <div class="row">

                                <div class="col-md-5">
                                    <div class="form-group">
                                    <label>Estado Operativo</label>
                                    <input class="form-control" type="text" name="EstadoOperativo" value="<?php echo $Inventarioequipo->EstadoOperativo; ?>" />
                                    
                                    </div>
                                </div>
                            </div>  
                            <div class="row"> <div class="col-md-7">
                                    <div class="form-group">
                                        <label> Observaciones</label>
                                    
                                    <input class="form-control" type="text" name="Observaciones" value="<?php echo $Inventarioequipo->Observaciones; ?>" />

                                    </div>
                                </div>
                            </div>
                                
                            <div class="row">
                                <select name="Unidad" class="form-control">
                                    <?php foreach($this->model->getUnidades() as $r): ?>
                                         <option <?php echo ($Inventarioequipo->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?></option>
                                         <?php endforeach; ?>
                                    ?>
                                </select>
                            </div>

                    

                        <button type="submit" id="btnSubmit" class="btn btn-info btn-fill pull-right">Guardar</button>
                        <div class="clearfix"></div>

                        



                       <!-- <A id="ini">Agregar Tipo</A>--> <!--aumentado esto por mi --> 

                       <a id ="agregardetalle" > <h4 style ="text-align:center" ;> Nuevo Detalle</h4> </a>



                        <div class=" row" >
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label> Descripcion </label>
                                    <!--
                                    <input type="text" id="Descripcion" class="form-control" value="<?php echo $Equipos->Descripcion; ?>" />
                                    -->
                                </div>
                            </div>
                            <div  class="col-md-5">
                                <div class="form-group">
                                    <label> Cantidad </label>
                                    <input type="number" id="Cantidad" name="Cantidad2" step =0.1 min=1 class="form-control" value="<?php $Inventarioequipos ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div  class="col-md-7">
                                <div class="form-group">
                                <label> Observaciones</label>
                                <input type="text" id ="Observaciones" name="Observaciones" step =1 min=1 class="form-control" value="<?php $Inventarioequipos ?>">
                                 </div>
                            </div>
                            
                            <div  class="col-md-3">
                                <div class="form-group">
                                <label> Año de Ingreso </label>
                                <input type="number" id ="AnoIngreso" name="Edad" step =1 min=1828 class="form-control" value="<?php $Inventarioequipos ?>">
                                </div>
                            </div>                            
                        </div>
                        <!--
                        <div class="row">
                            <div  class="col-md-5">
                                <div class="form-group">
                                    <label>Marca</label><
                                    <?php $cont=0; ?>
                                    <select id= "Marca22" class=" form-control"  >
                                        <?php foreach ($this->Materialinsumo->getrowId() as $s): ?>
                                            <option value="<?php echo $cont; ?>" > <?php echo $s->Marca ; ?>  </option>
                                        <?php $cont++ ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        -->
                        <h4>Detalles</h4>
                        <!--falta modificar esto un poco-->
                        <div class="content table-responsive table-full-width">

                            <table id="tableDetalle" class="table table-hover table-striped">
                                <thead><!--esto tambien da textura-->
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Observaciones</th>
                                    <th> Marca </th>
                                </thead>

                                <tbody Id="target-content">
                                    <?php $cont2=0 ?>
                                    <?php foreach($this->Inventariofdetalle->Listar(0) as $r): ?>
                                        <tr>
                                            <td><?php echo $r->Estado; ?></td>
                                            <td><?php echo $r->Cantidad; ?></td>
                                            <td><?php echo $r->Edad; ?></td>
                                            <td><?php echo $r->Observaciones; ?></td>
                                            <?php $marcatp=$this->Inventariofdetalle->getMarca($r->Material_Insumo_Id ); ?>
                                            <td><?php echo "$marcatp->Marca " ;?></td>
                                            <?php $cont2++?>
                                            <!--los %20son los espacios-->
                                            <td class=" cell-actions"><!--</td> class="cell-actions">-->
                                                <div class="btn-group">
                                                    <button type="button" rel="tooltip" title="Editar Detalle" class="btnEditDetalle btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button" rel="tooltip" title="Eliminar" class="btnDeleteDetalle btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                    </button>

                                                </div>

                                            </td>
                                            
                                        </tr>
                                        
                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>
                        </form>
                    </div>
                     
                    
                </div>
            </div>
        </div>
    </div>
</div>
