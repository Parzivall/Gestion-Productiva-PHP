<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo BASE_URL;?>UnidadesProductivas/">Unidades Productivas</a></li>
                        <li class="active"><?php echo $unidad->Id != null ? $unidad->Nombre : 'Nuevo Registro'; ?></li>
                    </ol>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">
                                    <?php echo $unidad->Id!=null ? $unidad->Nombre.' ('. $this->model->getRubroById($unidad->Rubro_Id).')' : 'Nuevo Registro: Unidades Productivas';?>
                                </h4>    
                            </div>
                        </div>
                    </div>

                    <div class="content crud">
                        <form method="post" action="<?php echo BASE_URL;?>UnidadesProductivas/Guardar/" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="Id" value="<?php echo $unidad->Id; ?>" />
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" name="Nombre" value="<?php echo $unidad->Nombre; ?>">
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rubro</label>
                                        <select name="Rubro" class="form-control">
                                            <?php foreach($this->model->getRubros() as $r): ?>
                                                <option <?php echo ($unidad->Rubro_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Descripcion;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="number" class="form-control" name="Telefono" placeholder="Telefono" value="<?php echo $unidad->Telefono;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefono:Anexo</label>
                                        <input type="number" class="form-control" name="Telefono_Anexo" value="<?php echo $unidad->Telefono_Anexo;?>" placeholder="Anexo del Telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Web</label>
                                        <input type="text" class="form-control" name="Web" placeholder="Web" value="<?php echo $unidad->Web;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fax:</label>
                                        <input type="text" class="form-control" name="Fax" value="<?php echo $unidad->Fax;?>" placeholder="Fax">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Celular:</label>
                                        <input type="number" class="form-control" name="Celular" value="<?php echo $unidad->Celular;?>" placeholder="Celular">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ubicacion:</label>
                                        <input type="text" class="form-control" name="Ubicacion" value="<?php echo $unidad->Ubicacion;?>" placeholder="Ubicacion">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ciudad</label>
                                        <select name="Ciudad" class="form-control">
                                            <?php foreach($this->model->getCiudades() as $r): ?>
                                                <option <?php echo ($unidad->Ciudad_Id==$r->Id) ? 'selected' : '' ?> value="<?php echo $r->Id?>" ><?php echo $r->Nombre;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-fill pull-right">Guardar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
