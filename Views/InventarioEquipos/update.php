<script type="text/javascript" src="<?php echo BASE_URL;?>Assets/js/jspdf.min.js"></script>

<script type="text/javascript">
var cantidadAcumulada = 0;
var editandoDetalle =false;
var rowEdit=null;
var tdId_insumo22='';
var tdCantidad=0;

    var verificarRequeridos = function(){
        if ($('#Marca').val()=='' || $('#Descripcion').val()=='' || 
            $('#Fabricado').val()=='' || $('#Modelo').val()=='' || 
            $('#NumeroS').val()=='' ){
            return false;
        }
        return true;
    }

    var saveEditDetalle = function(parent){
        
        var marca = $('#Marca').val()
        var descripcion = $('#Descripcion').val();
        var fabricado = $('#Fabricado').val();
        var numeroserie = $('#NumeroS').val();
        var modelo = $('#Modelo').val();
        parent.children("td:nth-child(1)").html(descripcion);
        parent.children("td:nth-child(2)").html(marca);
        parent.children("td:nth-child(3)").html(modelo);
        parent.children("td:nth-child(4)").html(numeroserie);
        parent.children("td:nth-child(5)").html(fabricado);


        parent.children("input:nth-child(8)").val(descripcion);
        parent.children("input:nth-child(9)").val(marca);
        parent.children("input:nth-child(10)").val(modelo);
        parent.children("input:nth-child(11)").val(numeroserie);
        parent.children("input:nth-child(12)").val(fabricado);
        cleanDetalle();
        editandoDetalle = false;
    }

        var editDetalle =  function(){
        editandoDetalle = true;
        var parent = $(this).closest("tr");
        rowEdit = parent;
        tddescripcion = parent.children("td:nth-child(1)").html();
        var tdmarca = parent.children("td:nth-child(2)").html();
        //el html cambia toodos los elementos por otro seleccionado o saca valor
        var tdmodelo = parent.children("td:nth-child(3)").html();
        var tdnumeroserie = parent.children("td:nth-child(4)").html();
        var tdfabricado = parent.children("td:nth-child(5)").html();


        $('#Descripcion').val(tddescripcion);
        $('#Marca').val(tdmarca);
        $('#Modelo').val(tdmodelo);
        $('#Fabricado').val(tdfabricado); 
        $('#NumeroS').val(tdnumeroserie); 
    }

    var deleteDetalle = function(){
        var parent = $(this).closest("tr");

        $(this).closest("tr").remove();
    }

    var cleanDetalle = function(){
        $('#Descripcion').val('');
        $('#Marca').val('');
        $('#Modelo').val('');
        $('#NumeroS').val(''); 
        $('#Fabricado').val(''); 
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
             saveEditDetalle(rowEdit);
        }
        else
        {
            var operacionToAppend = "<tr>";

            operacionToAppend += "<td>";
            operacionToAppend += $('#Descripcion').val();
            operacionToAppend += "</td>"
            operacionToAppend += "<td>";
            operacionToAppend += $('#Marca').val();
            operacionToAppend += "</td>";
            operacionToAppend += "<td>";
            operacionToAppend += $('#Modelo').val();
            operacionToAppend += "</td>";
            operacionToAppend += "<td>";
            operacionToAppend += $('#NumeroS').val();
            operacionToAppend += "</td>";
            operacionToAppend += "<td>";
            operacionToAppend += $('#Fabricado').val();
            operacionToAppend += "</td>";
            operacionToAppend += `<td class=" cell-actions">
                                        <button type="button" rel="tooltip" title="Editar Detalle" class="btnEditDetalle btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Eliminar" class="btnDeleteDetalle btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                </td>`;
            operacionToAppend += '<input type="hidden" name="IdDetalle1[]" value="'
            operacionToAppend += '';
            operacionToAppend += '">';
            operacionToAppend += '<input type="hidden" name="Descripcion1[]" value="'
            operacionToAppend += $('#Descripcion').val();
            operacionToAppend += '"/>';

            operacionToAppend += '<input type="hidden" name="Marca1[]" value="'
            operacionToAppend += $('#Marca').val();
            operacionToAppend += '"/>';
            operacionToAppend += '<input type="hidden" name="NumeroS1[]" value="'
            operacionToAppend += $('#NumeroS').val();
            operacionToAppend += '"/>';

            operacionToAppend += '<input type="hidden" name="Modelo1[]" value="'
            operacionToAppend += $('#Modelo').val();
            operacionToAppend += '"/>';

            operacionToAppend += '<input type="hidden" name="Fabricado1[]" value="'
            operacionToAppend += $('#Fabricado').val();
            operacionToAppend += '"/>';
            operacionToAppend += "</tr>";

            $('#tableOperacion').append(operacionToAppend);
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
                        <li><a href="<?php echo BASE_URL;?>InventarioEquipos/">InventariodeEquipos</a></li>
                        <li class="active"><?php echo $Inventarioequipos->Id != null ? $Inventarioequipos->Fecha_Ingreso : 'Nuevo Registro'; ?></li>
                    </ol>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">
                                    <?php echo $Inventarioequipos->Id!=null ? $Inventarioequipos->Fecha_Ingreso: 'Nuevo Registro: Inventario de Equipos';?>
                                    <!--.' ('. $this->model->getRubroById($unidad->Rubro_Id).')' no se necesito sJ-->
                                </h4>    
                            </div>
                        </div>
                    </div>

                    <ul style="text-align:left ; ">
                        <li> <A href="#agregardetalle"> <h5> Nuevo Equipo </h5> </A> </li> <!--es necesario el numeral <LI> <LI>-->
                    </ul>

                    <div class="content crud">
                        <form method="post" action="<?php echo BASE_URL;?>InventarioEquipos/Guardar/" enctype="multipart/form-data">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="Id" value="<?php echo $Inventarioequipos->Id; ?>" >

                                       <label class="text-danger">Fecha de Ingreso(*)</label>
                                        <!--onBlur="checkNameAvailability()" esto es un scripts + abajo-->
                                       <input type="date" class="form-control" placeholder="" name="Fecha_Ingreso"  value="<?php echo $Inventarioequipos->Fecha_Ingreso; ?>">
                                        <span id="name-availability-status"></span> 
                                        <!--css spam previamente definido-->
                                       <p><img src="<?php echo BASE_URL;?>Assets/img/LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>

                                    </div>
                                </div>  

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Condicion</label>
                                        
                                        <select name="Condicion" class="form-control">
                                                <option value="0"> Alquiler</option>
                                                <option value="1"> Propio</option>
                                        </select>

                                     </div>
                                </div>
    
                            </div>

                            <div class="row">

                                <div class="col-md-5">
                                    <div class="form-group">
                                    <label>Estado Operativo</label>
                                    <input class="form-control" type="text" name="EstadoOperativo" value="<?php echo $Inventarioequipos->EstadoOperativo; ?>" />
                                    
                                    </div>
                                </div>
                            </div>  

                            <div class="row"> <div class="col-md-7">
                                    <div class="form-group">
                                        <label> Observaciones</label>
                                    
                                    <input class="form-control" type="text" name="Observaciones" value="<?php echo $Inventarioequipos->Observaciones; ?>" >

                                    </div>
                                </div>
                            </div>
                                
                            <div class="row">
                                <select name="Unidad" class="form-control">
                                        <?php
                                        if (isset($_SESSION['Unidad_Id'])) {
                                            echo "<option selected value='".$_SESSION['Unidad_Id']."'>".$_SESSION['UnidadNombre']."2</option>";
                                        }
                                        else{?>
                                            <?php foreach($this->model->getUnidades() as $r): ?>
                                            <option <?php echo ($Inventarioequipos->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?></option>

                                             <?php endforeach; ?>
                                             
                                             <?php
                                             }
                                             ?>
                                </select>
                            </div>

                        <div class="row"> <div class="col-md-1"> </div></div>
                        <button type="submit" id="btnSubmit" class="btn btn-info btn-fill pull-right">Guardar</button>
                        <div class="clearfix"></div>

                      <div class=" card">
                        <div class="content">

                        <a id ="agregardetalle" > <h4 style ="text-align:center" ;> Nuevo Equipo </h4> </a>

                        <div class=" row" >
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label> Descripcion </label>
                                    <input type="text" id="Descripcion" name="Descripcion2" class="form-control" value="<?php echo " ";?>">
                                </div>
                            </div>
                            <div  class="col-md-5">
                                <div class="form-group">
                                    <label> Marca </label>
                                    <input type="text" id="Marca" name="Marca2" step =0.1 min=1 class="form-control" value="<?php echo "";?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div  class="col-md-4">
                                <div class="form-group">
                                    <label> Numero de Serie </label>
                                    <input type="text" id="NumeroS" name="NumeroS2" class="form-control" value="<?php echo "";?>">
                                </div>
                            </div>
                            
                            <div  class="col-md-5">
                                <div class="form-group">
                                <label> Modelo </label>
                                <input type="text" id ="Modelo" name="Modelo2" class="form-control" value="<?php echo ""; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div  class="col-md-5">
                                <div class="form-group">
                                <label> Fecha de Fabricacion</label>
                                <input type="date" id ="Fabricado" name="Fabricado2" class="form-control" value="<?php echo ""; ?>">
                                </div>
                            </div>
                        </div>

                        <button type="button" id="btnguardar" class="btn btn-info btn-fill pull-right">Guardar</button>



                        <h4 >Equipos</h4>
                        <div class="content table-responsive table-full-width">

                            <table id="tableOperacion" class="table table-hover table-striped">
                                <thead>esto tambien da textura
                                    <th>Descripcion</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>NumerodeSerie</th>
                                    <th>Fabricado en</th>
                                </thead>
                                <tbody id="target-content">
                                auxiacnx
                                <?php echo $Inventarioequipos->Id; ?>               
                                        <?php foreach($this->modelequipo->getEquipoporId( $Inventarioequipos->Id) as $r): ?>
                                            aaaa
                                        <tr>
                                        sbcusbcu
                                            <td><?php echo $r->Descripcion; ?></td>
                                            <td><?php echo $r->Marca; ?></td>
                                            <td><?php echo $r->Modelo; ?></td>
                                            <td><?php echo $r->NumeroSerie; ?></td>
                                            <td><?php echo $r->Fecha_Fabricacion ; ?></td>
                                            
                                            <td class=" cell-actions">
                                                <button type="button" rel="tooltip" title="Editar Detalle" class="btnEditDetalle btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                                </button>

                                                <button type="button" rel="tooltip" title="Eliminar" class="btnDeleteDetalle btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                                </button>
                                            </td>

                                            <input type="hidden" name="IdDetalle1[]"  value="<?php echo $r->Id;?>">

                                            <input type="hidden" name="Descripcion1[]" value="<?php echo $r->Descripcion;?> ">

                                           <input type="hidden" name="Marca1[]" value="<?php echo $r->Marca;?>">

                                           <input type="hidden" name="Modelo1[]" value="<?php echo $r->Modelo;?>">

                                           <input type="hidden" name="NumeroS1[]" value="<?php echo $r->NumeroSerie;?>">

                                           <input type="hidden" name="Fabricado1[]" value="<?php echo $r->Fecha_Fabricacion; ?>" > 
                                        </tr>
                                        <?php endforeach ?>
                                </tbody>
                                        
                            </table>
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