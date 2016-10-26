<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                                
                    <div class="content">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <h4 class="title">Operaciones</h4>    
                            </div>
                            <div class="col-md-2">
                                <form method="post" action="<?php echo BASE_URL;?>Operaciones/Crud">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Agregar Operacion</button>          
                                </form>
                            </div>
                        </div>

                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Tipo</th>
                                    <th>Monto</th>
                                    <th>Unidad</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </thead>
                                <tbody id="target-content">
                                    <?php foreach((isset($_SESSION['Unidad_Id']) ? $this->model->getOperacionesByUnidadId($_SESSION['Unidad_Id'], $startFrom) : $this->model->Listar($startFrom)) as $r): ?>
                                        <tr>
                                            <td><?php echo $r->Tipo==1 ? "Ingreso" : "Egreso" ; ?></td>
                                            <td><?php echo "S/.".$r->Monto; ?></td>
                                            <td><?php echo $this->model->getUnidadById($r->Unidad_Id); ?></td>
                                            <td><?php echo $r->Fecha; ?></td>
                                            <td class="cell-actions">
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Operaciones/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Operaciones/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!--PAGINACION-->
                        <nav><ul class="pagination">
                            <?php if(!empty($totalPages)):for($i=1; $i<=$totalPages; $i++):  
                                        if($i == 1):?>
                                        <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Operaciones/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                        <?php else:?>
                                        <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Operaciones/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li>
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
$(document).ready(function(){
    $('.pagination').pagination({
            items: <?php echo $totalRecords;?>,
            itemsOnPage: <?php echo resultsPerPage;?>,
            cssStyle: 'light-theme',
            currentPage : 1,
            onPageClick : function(pageNumber) {
                $("#target-content").html('Cargando...');
                var base = "<?php echo BASE_URL;?>";
                $("#target-content").load(base + "Operaciones/Pagination/Page/" + pageNumber);
            }
        });
    });
</script>