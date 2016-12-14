<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                                
                    <div class="content">
                    
                        <div class="row">

                            <div class="col-md-4">
                                <h4 class="title">Inventarios:</h4>    
                            </div>
                        
                            <div class="col-md-4">
                                <select class="form-control" name="Tablas" id="Tablas" onchange="location=this.value;">
                                    <option value="<?php echo BASE_URL;?>InventarioFisico" <?php if (isset($this->auxTable) && $this->auxTable=="InventarioFisico") echo 'selected'; ?>>Inventario Fisico</option>

                                    <option value="<?php echo BASE_URL;?>InventarioEquipos" <?php if (isset($this->auxTable) && $this->auxTable=="InventarioEquipo") echo 'selected'; ?> >Inventario de Equipos </option>

                                    <option value="<?php echo BASE_URL;?>InventarioBienes" <?php if(isset($this->auxTable) && $this->auxTable=="InventarioBienes")echo 'selected';?> > Inventario de Bienes </option>
                                </select>             
                            </div>
                            <!--$unidadescogida-->
                            <?php $unidadescogida="" ?>
                            <div class="col-md-4">
                                <select  class="form-control" name="Unidades" id="Unidades" onchange="location=this.value; >
                                <?php foreach($this->model->getUnidades($startFrom) as $r):  ?>
                                    <option value ="<?php echo $r->Id;?>" > <?php echo  $r->Nombre; $unidadescogida = $r->Id;?>
                                    </option>
                                <?php endforeach ?>
                                </select>
                            </div>


                        </div>

                        <div class="row">''    </div>

                        <div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <h4 class="title">Inventario Fisico</h4>    
                            </div>
                            <div class="col-md-2">
                                <form method="post" action="<?php echo BASE_URL;?>InventarioFisico/Crud"><!--esto se enviara post-->
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
                        <?php// $unidadescogida=$_REQUEST["Unidades"] ;?>
                            <table id="tableUnidades" class="table table-hover table-striped">
                                <thead>
                                    <th>Descripcion </th>
                                    <th>Periodo</th>
                                    <th>Cantidad</th>

                                </thead>

                                <tbody id="target-content">
                                    <?php echo "unidad $unidadescogida"; ?>
                                    <?php foreach($this->model->Listar($startFrom) as $r): ?>
                                        <?php if($r->Unidad_Id != $unidadescogida )
                                        {?>
                                        <tr>
                                            <td><?php echo $r->Descripcion_Existencia; ?></td>
                                            <td><?php echo $r->Periodo; ?></td>
                                            <td><?php echo ($this->model->getCantidadDetalle($r->Id)=='' ? "0" : $this->model->getCantidadDetalle($r->Id)); ?> </td>
                                            <!--los %20son los espacios-->
                                            <td class=" cell-actions"><!--</td> class="cell-actions">-->
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-warning buttonCrud"    href="<?php echo BASE_URL;?>InventarioFisico/Crud/<?php echo $r->Id; ?> "><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <!--e span de glyphicon-->
                                                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>InventarioFisico/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                </div>

                                            </td>
                                            
                                        </tr>
                                        
                                        <?php } ?>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </div>

                        <!--PAGINACION-->
                        <nav><ul class="pagination">
                            <?php if(!empty($totalPages)):for($i=1; $i<=$totalPages; $i++):  
                                        if($i == 1):?>
                                        <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>InventarioFisico/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                        <?php else:?>
                                        <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>InventarioFisico/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li>
                                    <?php endif;?>          
                            <?php endfor;endif;?>
                        </ul></nav>

                    </div>
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
                $("#target-content").load(base + "InventarioFisico/Pagination/Page/" + pageNumber);
            }
        });
    });
</script>