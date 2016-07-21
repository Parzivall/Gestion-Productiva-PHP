<script type="text/javascript" src="<?php echo BASE_URL;?>Assets/js/jspdf.min.js"></script>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo BASE_URL;?>Operaciones/">Operaciones</a></li>
                        <li class="active"><?php echo $operacion->Id != null ? $operacion->Tipo.'('.$operacion->Fecha.')' : 'Registro de Operación'; ?></li>
                    </ol>
                    <form method="post" action="<?php echo BASE_URL;?>Operaciones/Guardar/" enctype="multipart/form-data">
                        <div class="content">

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="title" id="Titulo">
                                        <?php echo $operacion->Id!=null ? ($operacion->Tipo==1 ? "Ingreso" : "Egreso").' ('. $this->model->getUnidadById($operacion->Unidad_Id).')' : 'Nuevo Registro: Operaciones';?>
                                    </h4>    
                                </div>
                                <div class="col-md-4">
                                    <button type="button" id="btnGenerarReporte" class="btn btn-primary btn-fill pull-right">Generar Reporte</button>        
                                </div>
                            </div>

                            <div class="content crud">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="Id" value="<?php echo $operacion->Id; ?>" />
                                            <label>Tipo</label>
                                            <select name="Tipo" class="form-control">
                                                <option <?php echo $operacion->Tipo==1 ? 'selected':''; ?> value="1">Ingreso</option>
                                                <option <?php echo $operacion->Tipo==2 ? 'selected':''; ?> value="2">Egreso</option>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Monto</label>
                                                <div class="input-group">
                                                  <div class="input-group-addon">S/.</div>
                                                    <input type="number" name="Monto" min="0" step="0.01" class="form-control" id="exampleInputAmount" placeholder="Amount" value="<?php echo $operacion->Id != null ? $operacion->Monto : "0"; ?>">
                                                  <div class="input-group-addon">.00</div>
                                                </div>
                                        </div>
                                    </div>    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Unidad Productiva</label>
                                            <select name="Unidad" class="form-control">
                                                <?php foreach($this->model->getUnidades() as $r): ?>
                                                    <option <?php echo ($operacion->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input type="date" name="Fecha" class="form-control" value="<?php echo $operacion->Id!=null ? $operacion->Fecha : date('Y-m-d')?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <a class="btn btn-info btn-fill pull-right btnMargin" href="<?php echo BASE_URL;?>Operaciones">Cancelar</a>                                        
                                        <button type="submit" class="btn btn-info btn-fill pull-right btnMargin" style="margin-right:1%">Guardar</button>
                                        <!--<div class="clearfix"></div>-->
                                        
                                        <!--<div class="clearfix"></div>-->
                                    </div>
                                </div>
                            </div>
                            <!-- This part will manage the Detalles From Operaciones -->
                            <div class="card">
                                <div class="content">
                                    <!--<div class="typo-line">
                                            <h4>Detalles:</h3>
                                            </div>-->
                                    <h4 style="text-align:center;">Detalles</h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card" style="padding:30px;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Descripcion</label>
                                                            <input type="text" class="form-control" name="DescripcionDetalle" placeholder="Descripcion" id="DescripcionDetalle" value="<?php echo "";?>">
                                                        </div>        
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Monto</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon">S/.</div>
                                                                <input type="number" name="MontoDetalle" min="0" step="0.01" class="form-control" id="MontoDetalle" placeholder="Amount" value="0">
                                                              <div class="input-group-addon">.00</div>
                                                            </div>
                                                        </div>       
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <button type="button" id="btnGuardarDetalle" class="btn btn-primary btn-fill pull-right">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div id="tableToGenerate">
                                                <div class="content table-responsive table-full-width">
                                                    <table class="table table-hover table-striped" id="tableDetalles">
                                                        <thead>
                                                            <th>Descripcion</th>
                                                            <th>Monto</th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody id="target-content">
                                                            <?php foreach($this->modelDetalleOperacion->getDetallesByOperacionId($operacion->Id) as $r): ?>
                                                                <tr>
                                                                    <td><?php echo $r->Descripcion ?></td>
                                                                    <td><?php echo "S/.".$r->Monto; ?></td>
                                                                    <td class="td-actions text-right">
                                                                        <button type="button" rel="tooltip" title="Editar Detalle" class="btnEditDetalle btn btn-info btn-simple btn-xs">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                        <button type="button" rel="tooltip" title="Eliminar" class="btnDeleteDetalle btn btn-danger btn-simple btn-xs">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var montoAcumulado = 0;
    var editandoDetalle = false;
    var rowEdit = null;
    var detallesArray = [];


    var genPDF = function(){
        /*
        var doc = new jsPDF();
        doc.text(20,20, "Universidad Nacional de San Agustin");
        doc.text(20,40, "Reporte de Ingreso/Egreso");

        doc.fromHTML($('#tableDetalles').get(0), 20,60,{'width':500});
        doc.save('reporte.pdf');
        */
        var pdf = new jsPDF('p', 'pt', 'ledger');
        pdf.text(240,60, "Universidad Nacional de San Agustin");
        pdf.text(260,80, "Reporte de Ingreso/Egreso");
        pdf.text(40,100, "Tipo(Unidad Productiva):");
        pdf.text(100,100, $('#Titulo').val());
        pdf.text(40, 120, "Monto Total:")
        pdf.text(160, 120, $('[name=Monto]').val());

        source = $('#tableToGenerate')[0];

        specialElementHandlers = {
            '#bypassme' : function(element, renderer) {
                return true
            }
        };
        margins = {
            top : 160,
            bottom : 60,
            left : 60,
            width : 300
        };
        
        pdf.fromHTML(source, // HTML string or DOM elem ref.
        margins.left, // x coord
        margins.top, { // y coord
            'width' : margins.width, // max width of content on PDF
            'elementHandlers' : specialElementHandlers
        },

        function(dispose) {
            // dispose: object with X, Y of the last line add to the PDF 
            //          this allow the insertion of new lines after html
            pdf.save('fileNameOfGeneretedPdf.pdf');
        }, margins);

    }

    var readRowsFromTable = function(){
        var table = document.getElementById('tableDetalles');
        var rowLength = table.rows.length;

        for(var i=1; i<rowLength; i+=1){
          var row = table.rows[i];
          //your code goes here, looping over every row.
          //cells are accessed as easy
          alert(row.cells[0].innerHTML);
          var cellLength = row.cells.length;
          /*
          for(var y=0; y<cellLength; y+=1){
            var cell = row.cells[y];

            //do something with every cell here
          }*/
        }
    }

    var saveEditDetalle = function(parent){
        var descripcion = $('#DescripcionDetalle').val();
        var monto = $('#MontoDetalle').val();
        var montoAnterior = parent.children("td:nth-child(2)").html();
        parent.children("td:nth-child(1)").html(descripcion);
        parent.children("td:nth-child(2)").html(monto);
        montoAcumulado -= parseInt(montoAnterior);
        montoAcumulado += parseInt(monto);
        cleanDetalle();
        editandoDetalle = false;
    }

    var editDetalle =  function(){
        editandoDetalle = true;
        var parent = $(this).closest("tr");
        rowEdit = parent;
        var tdDescripcion = parent.children("td:nth-child(1)").html();
        var tdMonto = parent.children("td:nth-child(2)").html();
        $('#DescripcionDetalle').val(tdDescripcion);
        $('#MontoDetalle').val(tdMonto);

    }
    var deleteDetalle = function(){
        var parent = $(this).closest("tr");
        var tdMonto = parent.children("td:nth-child(2)").html();
        montoAcumulado -= parseInt(tdMonto);
        $(this).closest("tr").remove();
    }
    var cleanDetalle = function(){
        $('#DescripcionDetalle').val('');
        $('#MontoDetalle').val('');
    }

    var verificarMonto = function(){
        var montoGeneral = parseInt($('[name=Monto]').val());
        var montoToAdd = parseInt($('#MontoDetalle').val());
        if ((montoAcumulado+montoToAdd) > montoGeneral){
            return false;
        }
        return true;
    }

    var verificarMontoEdit = function(){
        var montoGeneral = parseInt($('[name=Monto]').val());
        var montoAnterior = rowEdit.children("td:nth-child(2)").html();
        var montoToAdd = parseInt($('#MontoDetalle').val());
        if ((montoAcumulado-montoAnterior+montoToAdd) > montoGeneral){
            return false;
        }
        return true;   
    }

    $(document).ready(function(){
        //Set initial variables
        montoAcumulado = parseInt($('[name=Monto]').val());

        $('#btnGuardarDetalle').click(function(){
                      
            if (editandoDetalle){
                //Verificar que el monto a ingresar no sea mayor al total
                if(!verificarMontoEdit()){
                    alert("No puede ingresar un monto mayor al total");
                    return;
                }
                saveEditDetalle(rowEdit);
            }
            else{
                //Verificar que el monto a ingresar no sea mayor al total
                if (verificarMonto()==false){
                    alert("No puede ingresar un monto mayor al total");
                    return;
                }

                var detalleToAppend = "<tr>";
                detalleToAppend += "<td>";
                detalleToAppend += $('#DescripcionDetalle').val();
                detalleToAppend += "</td>"
                detalleToAppend += "<td>";
                detalleToAppend += $('#MontoDetalle').val();
                detalleToAppend += "</td>"
                detalleToAppend += `<td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Editar Detalle" class="btnEditDetalle btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Eliminar" class="btnDeleteDetalle btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>`;
                detalleToAppend += '<input type="hidden" name="DescripcionDetalle[]" value="'
                detalleToAppend += $('#DescripcionDetalle').val();
                detalleToAppend += '"/>';
                detalleToAppend += '<input type="hidden" name="MontoDetalle[]" value="'
                detalleToAppend += $('#MontoDetalle').val();
                detalleToAppend += '"/>';

                montoAcumulado += parseInt($('#MontoDetalle').val());
                cleanDetalle();                                
                $('#tableDetalles').append(detalleToAppend);
                $('.btnEditDetalle').bind("click", editDetalle);
                $('.btnDeleteDetalle').bind("click", deleteDetalle);    
            }
        });

        $('#btnGenerarReporte').click(genPDF);

    })

</script>