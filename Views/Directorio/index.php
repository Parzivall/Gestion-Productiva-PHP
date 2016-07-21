<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                                
                    <div class="content">
                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="title" style="text-align:center;">Directorio</h2>    
                            </div>
                        </div>
                        <br>

                        <div class="row" style="margin-left: 10%;margin-right: 10%">
                            <div class="col-md-12">
                                <h3>Busqueda:</h3>
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
                            <table id="tableDirectorio" class="table table-hover table-striped">
                                <thead>
                                    <th>Id</th>                                        
                                    <th>Nombre</th>
                                    <th>Rubro</th>
                                    <th>Web</th>
                                    <th>Telefono</th>
                                    <th>Anexo</th>
                                    <th>Celular</th>
                                    <th>Ubicacion</th>
                                    <th>Ciudad</th>
                                    <th>Responsable</th>
                                    <th></th>
                                </thead>
                                <tbody id="target-content">
                                    <?php foreach($this->model->Listar($startFrom) as $r): ?>
                                        <tr>
                                            <td><?php echo $r->Id; ?></td>
                                            <td><?php echo $r->Nombre; ?></td>
                                            <td><?php echo $this->model->getRubroById($r->Rubro_Id); ?></td>
                                            <td><?php echo $r->Web; ?></td>
                                            <td><?php echo $r->Telefono; ?></td>
                                            <td><?php echo $r->Telefono_Anexo; ?></td>
                                            <td><?php echo $r->Celular; ?></td>
                                            <td><?php echo $r->Ubicacion; ?></td>
                                            <td><?php echo $this->model->getCiudadById($r->Ciudad_Id); ?></td>
                                            <td><?php echo $this->model->getResponsableByDni($r->Persona_Dni); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!--PAGINACION-->
                        <nav><ul class="pagination">
                            <?php if(!empty($totalPages)):for($i=1; $i<=$totalPages; $i++):  
                                        if($i == 1):?>
                                        <li class='active'  id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Directorio/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li> 
                                        <?php else:?>
                                        <li id="<?php echo $i;?>"><a href='<?php echo BASE_URL;?>Directorio/Pagination/Page/<?php echo $i;?>'><?php echo $i;?></a></li>
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
var $rows = $('#tableDirectorio tr');
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
                $("#target-content").load(base + "Directorio/Pagination/Page/" + pageNumber);
            }
        });
    });
</script>