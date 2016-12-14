<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                                
                    <div class="content">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="title">Tablas Auxiliares:</h4>    
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="Tablas" id="Tablas" onchange="location=this.value;">
                                    <option value="<?php echo BASE_URL;?>Ciudades" <?php if (isset($this->auxTable) && $this->auxTable=="Ciudades") echo 'selected'; ?>>Ciudades</option>
                                    <option value="<?php echo BASE_URL;?>Rubros" <?php if (isset($this->auxTable) && $this->auxTable=="Rubros") echo 'selected'; ?>>Rubros</option>
                                    <option value="<?php echo BASE_URL;?>Cargos" <?php if (isset($this->auxTable) && $this->auxTable=="Cargos") echo 'selected'; ?>>Cargos</option>
                                    <!--<option value="<?php echo BASE_URL;?>UnidadMedida" <?php if (isset($this->auxTable) && $this->auxTable=="UnidadMedida") echo 'selected'; ?>>UnidadMedida</option>-->
                                </select>             
                            </div>
                        </div>
                        <br>
                        <form method="post" action="<?php echo BASE_URL;?>Ciudades/Guardar/">
                            <div class="card form-aux">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" required maxlength="100" class="form-control" name="Nombre" placeholder="Nombre" value="<?php echo $ciudad->Nombre;?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="Id" value="<?php echo $ciudad->Id; ?>" />
                                    <br>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Guardar</button>
                                        </div>
                                    </div>

                                </div>    
                            </div>
                            
                        </form>    

                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Id</th>                                        
                                    <th>Nombre</th>
                                </thead>
                                <tbody id="target-content">
                                    <?php foreach($this->model->Listar($startFrom) as $r): ?>
                                        <tr>
                                            <td><?php echo $r->Id; ?></td>
                                            <td><?php echo $r->Nombre; ?></td>

                                            <td class="cell-actions">
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Ciudades/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Ciudades/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                                        <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Ciudades/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                        <?php else:?>
                                        <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Ciudades/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li>
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
                $("#target-content").load(base + "Ciudades/Pagination/Page/" + pageNumber);
            }
        });
    });
</script>