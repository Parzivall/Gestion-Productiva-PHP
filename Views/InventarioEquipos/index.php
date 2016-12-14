<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                                
                    <div class="content">
                        <form method="post" action="<?php echo BASE_URL;?>InventarioEquipos/crud">
                        <div class="row">

                            <div class="col-md-4">
                                <h4 class="title">Inventarios:</h4>    
                            </div>
                        
                            <div class="col-md-8">
                                <select class="form-control" name="Tablas" id="Tablas" onchange="location=this.value;">
                                    <option value="<?php echo BASE_URL;?>InventarioFisico" <?php if (isset($this->auxTable) && $this->auxTable=="InventarioFisico") echo 'selected'; ?>>Inventario Fisico</option>

                                    <option value="<?php echo BASE_URL;?>InventarioEquipos" <?php if (isset($this->auxTable) && $this->auxTable=="InventarioEquipo") echo 'selected'; ?> >Inventario de Equipos </option>

                                    <option value="<?php echo BASE_URL;?>InventarioBienes" <?php if(isset($this->auxTable) && $this->auxTable=="InventarioBienes")echo 'selected';?> > Inventario de Bienes </option>
                                </select>             
                            </div>

                        </div>

                        <div class="row">''    </div>

                        <div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <h4 class="title">Inventario de Equipos</h4>    
                            </div>
                            <div class="col-md-2">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Agregar Inventario</button>            
                                </form>
                            </div>

                        </div>

                        <div class="row" style="margin-left: 10%;margin-right: 10%">
                            <div class="col-md-12">
                                <h4>Busqueda:</h4>
                            </div>                            
                        </div>

                        <div class="row" style="margin-left: 10%;margin-right: 10%">
                            <div class="col-md-12">
                                <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" id="search" class="search-query form-control" placeholder="Ingrese lo que desee Buscar" />
                                          <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                                        </div>
                                </div>
                            </div>    
                        </div>

                        <div class="content table-responsive table-full-width">

                            <table id="tableUnidades" class="table table-hover table-striped">

                                <thead>
                                    <th>Fecha de Ingreso </th>
                                    <th>Condicion</th>
                                    <th>Estado de Operatividad</th>
                                    
                                    <?php  
                                    if(!isset($_SESSION['Unidad_Id']))
                                    {?>
                                        <!--<th>Observaciones</th>-->
                                        <th> Observaciones</th>
                                    <?php } 
                                    else
                                    {?>
                                            <th>Observaciones</th>
                                      <?php  }?>
                                     
                                    
                                </thead>
        
                                <tbody id="target-content">
                                    <?php foreach($this->model->Listar($startFrom) as $r ) : ?>
                                        <?php
                                        if (isset($_SESSION['Unidad_Id']) ) {
                                            $unidadid=$_SESSION['Unidad_Id'];
                                            //$idequipo = $this->model->getInventarioId($unidadid);
                                            //aca faltaria la unidad productiva
                                        ?>
                                            <?php
                                            if( $r->Unidad_Id == $unidadid)
                                            {?>
                                                <tr>
                                                <td><?php echo $r->Fecha_Ingreso; ?> </td>
                                                <td><?php echo $r->Condicion; ?> </td>
                                                <td><?php echo $r->EstadoOperativo; ?> </td>

                                                <!--<td><?php echo $r->Observaciones; ?> </td>-->

                                                <td><?php echo 
                                                $this->model->getnombreUnidadId($r->Unidad_Id)->Nombre ?> </td>
                                                <!--los %20son los espacios-->
                                                <td class=" cell-actions">
                                                     <div class="btn-group">
                                                        <a class="btn btn-xs btn-warning buttonCrud"    href="<?php echo BASE_URL;?>InventarioEquipos/Crud/<?php echo $r->Id; ?> "><span class="glyphicon glyphicon-pencil"></span></a>

                                                        <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>InventarioEquipos/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                    </div>

                                                </td>
                                                
                                            </tr>
                                        <?php
                                            }
                                            
                                        }
                                        else{?>
                                        
                                            <tr>
                                                <td><?php echo $r->Fecha_Ingreso; ?> </td>
                                                <td><?php echo $r->Condicion; ?> </td>
                                                <td><?php echo $r->EstadoOperativo; ?> </td>

                                                <td><?php echo $r->Observaciones; ?> </td>
                                                <!--los %20son los espacios-->
                                                <td class=" cell-actions">
                                                     <div class="btn-group">
                                                        <a class="btn btn-xs btn-warning buttonCrud"    href="<?php echo BASE_URL;?>InventarioEquipos/Crud/<?php echo $r->Id; ?> "><span class="glyphicon glyphicon-pencil"></span></a>

                                                        <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>InventarioEquipos/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                        
                        <!--PAGINACION-->
                       <nav><ul class="pagination">
                            <?php if(!empty($totalPages)):for($i=1; $i<=$totalPages; $i++):  
                                        if($i == 1):?>
                                        <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>InventarioEquipos/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                        <?php else:?>
                                        <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>InventarioEquipos/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li>
                                    <?php endif;?>          
                            <?php endfor;endif;?>
                        </ul>
                        </nav> 

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var $rows = $('#tableUnidades tr');//esto es para la busqueda
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

$(document).ready(function(){
    $('.pagination').pagination({
            items: <?php echo $totalRecords;?>,
            itemsOnPage: <?php echo resultsPerPage;?>,
            cssStyle: 'light-theme',
            currentPage : 1,
            onPageClick : function(pageNumber) {
                $("#target-content").html('Cargando...');
                var base = "<?php echo BASE_URL;?>";
                $("#target-content").load(base + "InventarioEquipos/Pagination/Page/" + pageNumber);
            }
        });
    });

</script>