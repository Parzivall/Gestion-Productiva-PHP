<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                                
                    <div class="content">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <h4 class="title">Acciones:</h4>    
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="Tablas" id="Tablas" onchange="location=this.value;">
                                    <option value="<?php echo BASE_URL;?>Responsables" <?php if (isset($this->auxTable) && $this->auxTable=="Responsables") echo 'selected'; ?>>Asignar Responsables</option>
                                    <option value="<?php echo BASE_URL;?>UnidadesPersonas" <?php if (isset($this->auxTable) && $this->auxTable=="UnidadesPersonas") echo 'selected'; ?>>Asignar Personal a Unidades</option>
                                </select>         
                            </div>
                        </div>
                        <br>
                        <form method="post" action="<?php echo BASE_URL;?>Responsables/Guardar/">
                            <div class="card form-aux">
                                <div class="row" style="margin-left:30%; margin-right:30%;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Unidad Productiva</label>
                                                <select name="Unidad" class="form-control">
                                                    <?php foreach($this->model->getUnidadesProductivas() as $r): ?>
                                                        <option <?php echo ($responsable->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Responsable</label>
                                                <select name="Persona" class="form-control">
                                                    <?php foreach($this->model->getPersonas() as $r): ?>
                                                        <option <?php echo ($responsable->Persona_Dni==$r->Dni) ? 'selected' : '' ?> value="<?php echo $r->Dni;?>"><?php echo $r->Nombres.' '.$r->Apellidos;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>                                            
                                        </div>    
                                    </div>
                                    <input type="hidden" name="Id" value="<?php echo $responsable->Id; ?>" />
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-fill pull-right">Asignar</button>
                                            </div>
                                        </div>    
                                    </div>
                                </div>    
                            </div>
                            
                        </form>    

                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Id</th>                                        
                                    <th>Unidad Productiva</th>
                                    <th>Responsable</th>
                                </thead>
                                <tbody id="target-content">
                                    <?php foreach($this->model->Listar($startFrom) as $r): ?>
                                        <tr>
                                            <td><?php echo $r->Id; ?></td>
                                            <td><?php echo $this->model->getUnidadById($r->Unidad_Id); ?></td>
                                            <td><?php echo $this->model->getResponsableByDni($r->Persona_Dni); ?></td>

                                            <td class="cell-actions">
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Responsables/Crud/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Responsables/Eliminar/<?php echo $r->Id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                                        <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Responsables/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                        <?php else:?>
                                        <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Responsables/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li>
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
                $("#target-content").load(base + "Responsables/Pagination/Page/" + pageNumber);
            }
        });
    });
</script>