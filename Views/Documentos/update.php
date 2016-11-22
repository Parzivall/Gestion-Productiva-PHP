<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo BASE_URL;?>Documentos/">Documentos</a></li>
                        <li class="active"><?php echo $documento->Id != null ? $documento->Descripcion : 'Nuevo Registro'; ?></li>
                    </ol>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">
                                    <?php echo $documento->Id!=null ? $documento->Descripcion : 'Nuevo Registro: Documentos';?>
                                </h4>    
                            </div>
                        </div>

                    <div class="content">
                        <form method="post" action="<?php echo BASE_URL;?>Documentos/Guardar/" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Unidad Productiva</label>
                                        <select name="Unidad" class="form-control">
                                            <?php
                                                if (isset($_SESSION['Unidad_Id'])) {
                                                    echo "<option selected value='".$_SESSION['Unidad_Id']."'>".$_SESSION['UnidadNombre']."</option>";
                                                } else { ?>
                                                    <?php foreach($this->modelUnidadProductiva->getAll() as $r): ?>
                                                        <option <?php echo ($documento->Unidad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?></option>
                                                    <?php endforeach; ?>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="Id" value="<?php echo $documento->Id; ?>" />
                                        <label class="text-danger">Descripción (*)</label>
                                        <input type="text" maxlength="200" class="form-control" name="Descripcion" id="Descripcion" placeholder="Descripción" value="<?php echo $documento->Descripcion;?>">
                                    </div>    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Documento</label>
                                        <select name="Tipo_Documento" class="form-control">
                                            <?php foreach($this->modelTipoDocumento->getAll() as $r): ?>
                                                <option <?php echo ($documento->Tipo_Documento_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id;?>"><?php echo $r->Descripcion;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-danger">N° de Documento (*)</label>
                                        <input type="text" required maxlength="100" name="Numero_Documento" class="form-control" placeholder="Numero del Documento" value="<?php echo $documento->Numero;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-danger">Fecha de Legalizacion (*)</label>
                                        <input type="date" required class="form-control" name="Fecha_Legalizacion" value="<?php echo $documento->Fecha_Legalizacion?>">    
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-danger">N° de Folios (*)</label>
                                        <input type="text" required maxlength="100" name="Numero_Folios" class="form-control" placeholder="Numero de Folios" value="<?php echo $documento->Numero_Folios;?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-danger">Estado Operativo (*)</label>
                                        <input type="text" required maxlength="100" name="EstadoOperativo" class="form-control" placeholder="Estado Operativo" value="<?php echo $documento->EstadoOperativo;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observaciones:</label>
                                        <textarea rows="5" maxlength="400" name="Observaciones" class="form-control" placeholder="Observaciones"><?php echo $documento->Observaciones;?></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="btnSubmit" class="btn btn-info btn-fill pull-right">Guardar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(function(){
    $("form").submit(function() {
        $(this).submit(function() {
            return false;
        });
        return true;
    });
});
</script>