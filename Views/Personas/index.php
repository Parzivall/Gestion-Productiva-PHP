<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">Personas</h4>    
                            </div>
                            <div class="col-md-6">
                                <form method="post" action="<?php echo BASE_URL;?>Personas/Crud">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Agregar Persona</button>            
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
                                            <input type="text" id="search" class="search-query form-control" placeholder="¿A quien desea Buscar?" />
                                          <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                                        </div>
                                </div>
                            </div>    
                        </div>
                    
                        <div id="target-search">
                            <div class="content table-responsive table-full-width">
                                <table id="tablePersonas" class="table table-hover table-striped">
                                    <thead>
                                        <th>Dni</th>
                                        <th>Usuario</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Nacimiento</th>
                                        <th>Sexo</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="target-content">
                                        <?php foreach($this->model->Listar($startFrom) as $r): ?>
                                            <tr>
                                                <td><?php echo $r->Dni; ?></td>
                                                <td><?php echo $r->Username; ?></td>
                                                <td><?php echo $r->Nombres; ?></td>
                                                <td><?php echo $r->Apellidos; ?></td>
                                                <td><?php echo $r->Direccion; ?></td>
                                                <td><?php echo $r->Telefono; ?></td>
                                                <!--<td><?php echo $r->Email; ?></td>-->
                                                <!--<td><?php echo $r->Web; ?></td>-->
                                                <td><?php echo $r->Nacimiento; ?></td>
                                                <td><?php echo $r->Genero == 1 ? 'Hombre' : 'Mujer'; ?></td>

                                                <td class="cell-actions">
                                                    <div class="btn-group">
                                                        <a class="btn btn-xs btn-warning buttonCrud" href="<?php echo BASE_URL; ?>Personas/Crud/<?php echo $r->Dni; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                                        <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-xs btn-danger buttonCrud" href="<?php echo BASE_URL; ?>Personas/Eliminar/<?php echo $r->Dni; ?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                                            <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Personas/Paginacion/Pagina/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                            <?php else:?>
                                            <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Personas/Paginacion/Pagina/<?php echo $i;?>'><?php echo $i;?></a></li>
                                        <?php endif;?>          
                                <?php endfor;endif;?>
                            </ul></nav>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var $rows = $('#tablePersonas tr');


$('#search').bind('input',function(){  
   var base = "<?php echo BASE_URL;?>";
   var txt = $(this).val();  
    $.ajax({  
         url: base + "Personas/Buscar/",
         method:"post",  
         data:{search:txt},  
         dataType:"text",  
         success:function(data)  
         {  
            $('#target-search').html(data);  
            $('.pagination').pagination({
                items: $('#totalRecords').val(),
                itemsOnPage: <?php echo resultsPerPage;?>,
                cssStyle: 'light-theme',
                currentPage : 1,
                onPageClick : function(pageNumber) {
                    $("#target-content").html('Cargando...');
                    var base = "<?php echo BASE_URL;?>";
                    $("#target-content").load(base + "Personas/Paginacion/Pagina/" + pageNumber + "/Busqueda/" + txt);
                }
            });
         }  
    });
});  

$(document).ready(function(){
    /*
    $('.pagination').pagination({
        items: <?php echo $totalRecords;?>,
        itemsOnPage: <?php echo resultsPerPage;?>,
        cssStyle: 'light-theme',
        currentPage : 1,
        onPageClick : function(pageNumber) {
            $("#target-content").html('Cargando...');
            var base = "<?php echo BASE_URL;?>";
            $("#target-content").load(base + "Personas/Pagination/Page/" + pageNumber);
        }
    });
    */

    $('.pagination').pagination({
        items: <?php echo $totalRecords;?>,
        itemsOnPage: <?php echo resultsPerPage;?>,
        cssStyle: 'light-theme',
        currentPage : 1,
        onPageClick : function(pageNumber) {
            $("#target-content").html('Cargando...');
            var base = "<?php echo BASE_URL;?>";
            $("#target-content").load(base + "Personas/Paginacion/Pagina/" + pageNumber);
        }
    });
});
</script>