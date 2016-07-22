<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                                
                    <div class="content">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <h4 class="title">Cronogramas(Actividades)</h4>    
                            </div>
                        </div>
                        <br>
                        <form method="post" action="<?php echo BASE_URL;?>Cronogramas/Guardar/">
                            <div class="card form-aux">
                                <div class="row" style="margin-left:20%; margin-right:20%;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Unidad Productiva</label>
                                                <select name="Unidad" class="form-control">
                                                    <?php foreach($this->model->getUnidadesProductivas() as $r): ?>
                                                        <option <?php echo ($cronograma->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Descripcion</label>
                                                <input type="text" required maxlength="50" class="form-control" name="Descripcion" placeholder="Descripcion" value="<?php echo $cronograma->Descripcion;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="Id" value="<?php echo $cronograma->Id; ?>" />
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fecha Inicio</label>
                                                <input type="date" required class="form-control" name="FechaInicio"  value="<?php echo $cronograma->Id!=null ? $cronograma->FechaInicio : date('Y-m-d');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fecha Fin</label>
                                                <input type="date" required class="form-control" name="FechaFin" value="<?php echo $cronograma->Id!=null ? $cronograma->FechaFin : date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="checkbox">
                                                        <input name="Cumplido" type="checkbox" value="" style="zoom:1.8;" data-toggle="checkbox">Cumplido
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-fill pull-right">Guardar</button>
                                            </div>
                                        </div>    
                                    </div>
                                </div>    
                            </div>
                            
                        </form>    

                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Unidad</th>
                                    <th>Descripcion</th>
                                    <th>Cumplido</th>
                                    <th>FechaInicio</th>
                                    <th>FechaFin</th>
                                </thead>
                                <tbody id="target-content">
                                    <?php foreach($this->model->Listar($startFrom) as $r): ?>
                                        <tr>
                                            <td><?php echo $this->model->getUnidadById($r->Unidad_Id); ?></td>
                                            <td><?php echo $r->Descripcion ?></td>
                                            <td>
                                                <label class="checkbox">
                                                    <input type="checkbox" disabled data-toggle="checkbox" <?php echo $r->Cumplido ? 'checked' : "" ?>>
                                                </label>
                                            </td>
                                            <td><?php echo $r->FechaInicio; ?></td>
                                            <td><?php echo $r->FechaFin; ?></td>

                                            <td class="cell-actions">
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Cronogramas/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Cronogramas/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                                        <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Cronogramas/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                        <?php else:?>
                                        <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Cronogramas/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li>
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
                $("#target-content").load(base + "Cronogramas/Pagination/Page/" + pageNumber);
            }
        });
    });
</script>