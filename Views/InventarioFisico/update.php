<script type="text/javascript" src="<?php echo BASE_URL;?>Assets/js/jspdf.min.js"></script>

<script type="text/javascript">//aca guarda el detalle y todo lo demas
//btnGuardarDetalleFisico
//verificar el estado
//para añadir una nuevo material insumo se tiene que añadir por una tabla auxiliar
//me falta que lo que yo guardo aparesca en la tabla contigua averiguar

var cantidadAcumulada = 0;
var editandoDetalle =false;
var rowEdit=null;
var tdId_insumo22='';
var tdCantidad=0;
    var verificarRequeridos = function(){
        if ($('#Observaciones').val()=='' || $('#Cantidad').val()=='' || 
            $('#AnoIngreso').val()=='' || $('#Estado').val()=='' || 
            $('#DescripcionDetalle').val()=='' ){
            return false;
        }
        //if($('#Cantidad').val() !='' && $('#Cantidad').val() % 2 ==0)
        //    return false;   
        return true;
    }
    
    var flag = true;

    var actualizarCantidadTotal = function()
    {
        alert("Actualizar:" + tdCantidad);
        //Actualizar el monto total
        $('[name=Cantidad22]').val(cantidadAcumulada.toFixed(2));
    }

    var saveEditDetalle = function(parent){
        
        var cantidad = $('#Cantidad').val()
        var estado = $('#Estado').val();
        var anoingreso = $('#AnoIngreso').val();
        var cantidadAnterior = parent.children("td:nth-child(1)").html();
        var id_insumo = $('#Marca22').val();
        var Observaciones = $('#Observaciones').val();
        var tdId_insumo22=$("#Marca22 option:selected").html();//saco el contenido del seleccionado
        
        parent.children("td:nth-child(1)").html(cantidad);
        parent.children("td:nth-child(2)").html(estado);
        parent.children("td:nth-child(3)").html(anoingreso);
        parent.children("td:nth-child(4)").html(Observaciones);
        parent.children("td:nth-child(5)").html(tdId_insumo22);
        //estono me sale ademas me sale de un foranea llave yo cambie por char
        parent.children("input:nth-child(8)").val(cantidad);
        parent.children("input:nth-child(9)").val(estado);
        parent.children("input:nth-child(11)").val(anoingreso);
        parent.children("select:nth-child(10)").val(id_insumo);
        parent.children("input:nth-child(12)").val(Observaciones);
        actualizarCantidadTotal();//en vez del monto el mio seria la cantidad
        alert("guardando datos");
        cleanDetalle();
        cantidadAcumulada -= parseFloat(cantidadAnterior);//lee todo y solo regresa el primer numero
        cantidadAcumulada += parseFloat(cantidad);

        editandoDetalle = false;
    }

    var editDetalle =  function(){
        editandoDetalle = true;
        var parent = $(this).closest("tr");
        rowEdit = parent;
        tdCantidad = parent.children("td:nth-child(1)").html();
        var tdEstado = parent.children("td:nth-child(2)").html();
        //el html cambia toodos los elementos por otro seleccionado o saca valor
        var tdAnoIngreso = parent.children("td:nth-child(3)").html();
        var tdObservaciones = parent.children("td:nth-child(4)").html();
        var tdId_insumo = parent.children("td:nth-child(5)").html();

        $('#Cantidad').val(tdCantidad);
        $('#Estado').val(tdEstado);
        $('#AnoIngreso').val(tdAnoIngreso);
        $('#Observaciones').val(tdObservaciones); 
        
        var valorint = parseFloat(tdId_insumo);   
        $('#Marca22').val(valorint);////////esto falta
        //editandoDetalle = false;
    }


    var deleteDetalle = function(){
        alert("Quitando:" + tdCantidad);
        var parent = $(this).closest("tr");
        //var tdCantidad = parent.children("td:nth-child(1)").html();
        //cantidadAcumulada -= parseFloat(tdCantidad);
        //actualizarCantidadTotal();
        editandoDetalle=false;
        $(this).closest("tr").remove();
    }

    var cleanDetalle = function(){
        $('#Cantidad').val('');
        $('#Estado').val('');
        $('#Observaciones').val('');
        $('#AnoIngreso').val(''); 
        $('#Marca22').val(0); 
    }

    $(document).ready(function(){
        //esto se ejcuta al momento de poner sips
        $('.btnEditDetalle').bind("click", editDetalle);
        $('.btnDeleteDetalle').bind("click", deleteDetalle);

        $('#btnguardar').click(function(){
            //editandoDetalle =true
            if(!verificarRequeridos()){
                alert('Ingrese ');
                return;
            }

            if (editandoDetalle){
                alert('Ingrese el detalle a guardar' + rowEdit);
                saveEditDetalle(rowEdit);
            }
            else{

                var detalleToAppend = "<tr>";
                detalleToAppend += "<td>";
                detalleToAppend += $('#Cantidad').val();
                detalleToAppend += "</td>"                
                detalleToAppend += "<td>";
                detalleToAppend += $('#Estado').val();
                detalleToAppend += "</td>"
                detalleToAppend += "<td>";                
                detalleToAppend += $('#AnoIngreso').val();
                detalleToAppend += "</td>"
                detalleToAppend += "<td>";
                detalleToAppend += $('#Observaciones').val();
                detalleToAppend += "</td>"
                detalleToAppend += "<td>";
                detalleToAppend += $("#Marca22 option:selected").html();
                detalleToAppend += "</td>"

                detalleToAppend += `<td class=" cell-actions">
                                        <button type="button" rel="tooltip" title="Editar Detalle" class="btnEditDetalle btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Eliminar" class="btnDeleteDetalle btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>`;
                detalleToAppend += '<input type="hidden" name="IdDetalle[]" value="'
                detalleToAppend += '';
                detalleToAppend += '">';
                detalleToAppend += '<input type="hidden" name="CantidadDetalle[]"   value="'
                detalleToAppend += $('#Cantidad').val();
                detalleToAppend += '">';
                detalleToAppend += '<input type="hidden" name="Estado1[]" value="'
                detalleToAppend += $('#Estado').val();
                detalleToAppend += '">';
                detalleToAppend += '<input type="hidden" name="Marca1[]" value="'
                detalleToAppend += $('#Marca22').val();
                detalleToAppend += '">';
                detalleToAppend += '<input type="hidden" name="AnoIngreso1[]" value="'
                detalleToAppend += $('#AnoIngreso').val();
                detalleToAppend += '">';
                detalleToAppend += '<input type="hidden" name="Observar[]" value="'
                detalleToAppend += $('#Observaciones').val();
                detalleToAppend += '">';
                detalleToAppend += "</tr>";
                
                cantidadAcumulada += parseFloat($('#Cantidad').val());
                $('#tableDetalle').append(detalleToAppend);
                actualizarCantidadTotal();
                cleanDetalle();                                
                $('.btnEditDetalle').bind("click", editDetalle);
                $('.btnDeleteDetalle').off().on("click", deleteDetalle); 
            }

        });

    });

</script>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo BASE_URL;?>InventarioFisico/">InventarioFisico</a></li>
                        <li class="active"><?php echo $Inventariofisico->Id != null ? $Inventariofisico->Descripcion_Existencia : 'Nuevo Registro'; ?></li>
                    </ol>
                        
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">
                                    <?php echo $Inventariofisico->Id!=null ? $Inventariofisico->Descripcion_Existencia: 'Nuevo Registro: InventarioFisico';?>
                                    <!--.' ('. $this->model->getRubroById($unidad->Rubro_Id).')' no se necesito sJ-->
                                </h4>    
                            </div>
                        </div>
                    </div>

                    <ul style="text-align:left ; ">
                            <li> <A href="#agregardetalle"> <h5> Agregar Detalle </h5> </A> </li> <!--es necesario el numeral <LI> <LI>-->
                    </ul>

                    
                        <form method="post" action="<?php echo BASE_URL;?>InventarioFisico/Guardar/" enctype="multipart/form-data"    >
                        <div class="content">
                        <!--<div class="content">-->
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <input type="hidden" name="Id" value="<?php echo              $Inventariofisico->Id; ?>">

                                        <label class="text-danger">Descripcion de Existencia(*)</label>
                                        <!--onBlur="checkNameAvailability()" esto es un scripts + abajo-->
                                        <input type="text" required maxlength="100" class="form-control" placeholder="eje muebles" name="Descripcion"  value="<?php echo $Inventariofisico->Descripcion_Existencia; ?>">
                                        <span id="name-availability-status"></span>
                                        <!--css spam previamente definido-->
                                       <!-- <p><img src="<?php echo BASE_URL;?>Assets/img/LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>-->

                                    </div>
                                </div>  

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Periodo</label>
                                        <input type="date" class="form-control" name="Periodo1" min = "1828-01-00" max ="<?php date("Y-m-d");?>" placeholder="<?php echo date("Y-m-d");?>" value='<?php echo $Inventariofisico->Periodo; ?>' required>
                                        <!--esto averiguar como ponerlo corectamente-->
                                    </div>
                                </div>

                            </div>

                              <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Unidad Productiva</label>
                                            <select name="Unidad" class="form-control">
                                                <?php
                                                    if (isset($_SESSION['Unidad_Id'])) {
                                                        echo "<option selected value='".$_SESSION['Unidad_Id']."'>".$_SESSION['UnidadNombre']."2</option>";
                                                    }
                                                    else{?>
                                                    <?php foreach($this->model->getUnidades() as $r): ?>
                                                            <option <?php echo ($Inventariofisico->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?> </option>
                                                        <?php endforeach; ?>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> 

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipos de Inventario</label>
                                        <select name="TipoInventario" class="form-control" >
                                                <?php foreach($this->model->getTipos_inventarios() as $r): ?>
                                                    <!--<?php echo "llal"?>-->
                                                        <option <?php echo ($Inventariofisico->TipoExistencia_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Descripcion;?></option>
                                                        <?php endforeach; ?>
                                                ?>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label>Unidad Medida</label>
                                         <select name="UnidadMedida" class="form-control">
                                                <?php foreach($this->model->getUnidadMedida() as $r): ?>
                                                        <option <?php echo ($Inventariofisico->UnidadMedida_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Descripcion;?></option>
                                                        <?php endforeach; ?>
                                                ?>

                                        </select>                                       
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cantidad </label>
                                        <input type="number"  name="codigo2" class="form-control"  
                                        min="0" step="1"  placeholder="0"  disabled required value="<?php echo   $Inventariofisico->Id != null ? ($this->model->getCantidadDetalle($Inventariofisico->Id) =='' ?  "0" : $this->model->getCantidadDetalle($Inventariofisico->Id) ) : " 0 "; ?>" >

                                        <!--esto averiguar como ponerlo corectamente-->
                                    </div>
                                </div>

                            </div>

                            <button type="submit" id="btnSubmit" class="btn btn-info btn-fill pull-right">Guardar</button>
                            <div class="clearfix"></div>
                        

                       <!-- <A id="ini">Agregar Tipo</A>--> <!--aumentado esto por mi --> 
                       <div class=" card">
                            <div class="content">
                       <a id ="agregardetalle" > <h4 style ="text-align:center" ;> Nuevo Detalle</h4> </a>

                        <div class=" row" >
                            <div class="col-md-5">
                            <div class="form-group">
                                <label> Estado </label>
                                <!--<select name = "Estado" class=" form-control" >
                                    <option id = "EBueno" value = <?php  echo "0";?> >Bueno</option>
                                    <option id ="ERegular" value = "1"<?php  echo "1";?> > Regular</option>que esta regular
                                    <option id ="EMalo" value = "2" <?php  echo 2; ?>>Malo</option>que esta bien
                                    this->model->getCantidadDetalle($Inventariofisico->Codigo_Existencia)
                                </select>-->
                                <input type="number" id="Estado" name="Estado3" step =1 min=1 max=3 class="form-control">

                            </div>
                            </div>
                            
                            <div  class="col-md-5">
                                <div class="form-group">
                                <label> Cantidad </label>
                                <input type="number" id="Cantidad" name="Cantidad22" step =0.1 min=1 class="form-control" value="<?php $Inventariofisico ?>">
                            </div>
                            </div>

                        </div>

                        <div class="row">
                            <div  class="col-md-7">
                                <div class="form-group">
                                <label> Observaciones</label>
                                <input type="text" id ="Observaciones" name="Observaciones" step =1 min=1 class="form-control" value="<?php echo " ";?>">
                                 </div>
                            </div>
                            
                            <div  class="col-md-3">
                                <div class="form-group">
                                <label> Fecha de Ingreso </label>
                                <input type="date" id ="AnoIngreso" name="AnoIngreso" step =1 min= "1828-01-00" max ="<?php date("Y-m-d");?>" class="form-control" value="<?php echo " ";?>"  placeholder="<?php echo date("Y-m-d");?>">
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div  class="col-md-5">
                                <div class="form-group">
                                <label>Marca</label><!--observarlo despues-->
                                <?php $cont=0; ?>
                                <select id= "Marca22"  name ="Marca22" class=" form-control"  >
                                    <?php foreach ($this->Materialinsumo->getrowId() as $s): ?>
                                        <option value="<?php echo $cont; ?>" > <?php echo $s->Marca ; ?>  </option>
                                    <?php $cont++ ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            </div>

                        </div>

                        <!--<form method="post" id="btnGuardarDetalleFisico" enctype="multipart/form-data">-->
                        <!--button-->
                            <button type="button" id="btnguardar" class="btn btn-info btn-fill pull-right">Guardar</button>
                        <!--</form>-->

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
                                    <!--<?php $cont2=0 ?>-->
                                    <tbody id="target-content">
                                    <!--$this->modeldetalle->Listar($Inventariofisico->Id-->
                                    <!--<?php echo "llaa = $Inventariofisico->Id rrr";?>-->
                                    dmwomd
                                    <?php foreach($this->modeldetalle->getDetallesByIFisicoId($Inventariofisico->Id) as $r):?>
                                        sdmsod
                                        <p>sdsd11</p>
                                        asa11
                                        <tr>
                                            <td><?php echo $r->Cantidad; ?></td>
                                            <td><?php echo $r->Estado; ?></td>
                                            <td><?php echo $r->Edad; ?></td>
                                            <td><?php echo $r->Observaciones; ?></td>
                                            <?php $marcatp=$this->modeldetalle->getMarca($r->Material_Insumo_Id ); ?>
                                            <td><?php echo $marcatp->Marca; ?></td>
                                            <?php $cont2++?>
                                            <!--los %20son los espacios-->


                                            <td class=" td-actions text-right"><!--</td> class="cell-actions">-->
                                                
                                                    <button type="button" rel="tooltip" title="Editar Detalle" class="btnEditDetalle btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button" rel="tooltip" title="Eliminar" class="btnDeleteDetalle btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                    </button>

                                            </td>
                                           <!-- <td>-->
                                                <input type="hidden" name="IdDetalle[]"  value="<?php echo  $r->Id;?>">

                                                <input type="hidden" name="CantidadDetalle[]" value="<?php echo $r->Cantidad;?> ">

                                               <input type="hidden" name="Estado1[]" value="<?php echo    $r->Estado;?>">

                                               

                                               <input type="hidden" name="Marca1[]" value="<?php echo     $r->Material_Insumo_Id;?>">


                                               <input type="hidden" name="AnoIngreso1[]" value="<?php echo $r->Edad;?>">

                                                <input type="hidden" name="Observar[]" value="<?php    echo  $r->Observaciones; ?>">
                                           <!--</td>-->

                                        </tr>                                 
                                        
                                    <?php endforeach; ?>

                                </tbody>

                            </table>

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
</div>
