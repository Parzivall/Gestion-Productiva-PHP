<?php
    //Almacenar el Usuario temporal para saltar la verificación en caso el usuario sea el mismo
    if ($persona->Dni!=null){
        $tmpUser = $persona->Username;    
    }
    else{
        $tmpUser = "";
    }
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo BASE_URL;?>Personas/">Personas</a></li>
                        <li class="active"><?php echo $persona->Dni != null ? $persona->Nombres : 'Nuevo Registro'; ?></li>
                    </ol>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">
                                    <?php echo $persona->Dni!=null ? $persona->Nombres.' '.$persona->Apellidos : 'Nuevo Registro: Personas';?>
                                </h4>    
                            </div>
                        </div>

                    <div class="content">
                        <form method="post" action="<?php echo BASE_URL;?>Personas/Guardar/" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-danger">Dni (*)</label>
                                                <input required maxlength="20" type="text" name="Dni" id="Dni" class="form-control" <?php echo $persona->Dni!=null ? "disabled": "" ?> placeholder="Dni" onBlur="checkDniAvailability()" value="<?php echo $persona->Dni; ?>"/>
                                                <input type="hidden" name="DniUpdate" value="<?php echo $persona->Dni ? $persona->Dni : -1; ?>"/>
                                                <span id="dni-availability-status"></span>
                                                <p><img src="<?php echo BASE_URL;?>Assets/img/LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Usuario</label>
                                                <input type="text" maxlength="20" class="form-control" name="Username" id="Username" onBlur="checkUserAvailability()" placeholder="Nombre de Usuario" value="<?php echo $persona->Username;?>">
                                                <span id="user-availability-status"></span>
                                                <p><img src="<?php echo BASE_URL;?>Assets/img/LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contraseña</label>
                                                <input type="password" maxlength="20" name="Password" class="form-control" placeholder="Contraseña" value="<?php echo $persona->Password;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-danger">Nombres (*)</label>
                                                <input type="text" required maxlength="50" name="Nombres" class="form-control" placeholder="Nombres" value="<?php echo $persona->Nombres?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-danger">Apellidos (*)</label>
                                                <input type="text" required maxlength="50" name="Apellidos" class="form-control" placeholder="Apellidos" value="<?php echo $persona->Apellidos;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Genero:</label>
                                                <select class="form-control" name="Genero">
                                                    <option value="1" <?php if ($persona->Genero==1) echo 'selected'; ?>>Masculino</option>
                                                    <option value="2" <?php if ($persona->Genero==2) echo 'selected'; ?>>Femenino</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-danger">Fecha de Nacimiento (*)</label>
                                                <input type="date" required class="form-control" name="Nacimiento" value="<?php echo $persona->Nacimiento?>">    
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Telefono</label>
                                                <input type="number" class="form-control" name="Telefono" placeholder="Telefono" value="<?php echo $persona->Telefono;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-4">
                                    <div class="card card-user">
                                        <div class="text-center">
                                            <label>Foto</label>    
                                            <br>
                                            <img class="img-rounded" alt="..." src="<?php echo BASE_URL;?>Assets/img/default-avatar.png">
                                            <br>
                                            <div class="fileUpload btn btn-info">
                                                <span>Subir Foto</span>
                                                <input type="file" class="upload" name="Foto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" maxlength="100" class="form-control" name="Direccion" placeholder="Direccion" value="<?php echo $persona->Direccion;?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" maxlength="50" class="form-control" name="Email" placeholder="Email" value="<?php echo $persona->Email;?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pagina web</label>
                                        <input type="url" maxlength="100" class="form-control" name="Web" value="<?php echo $persona->Web;?>" placeholder="Web">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Acerca de:</label>
                                        <textarea rows="5" maxlength="400" name="Informacion" class="form-control" placeholder="Descripción de la persona, puesto anterior, etc"><?php echo $persona->Informacion;?></textarea>
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
function checkDniAvailability() {
    var base = "<?php echo BASE_URL;?>";
    $("#loaderIcon").show();
    jQuery.ajax({
    url: base+"Personas/Verificar/",
    data:'Dni='+$("#Dni").val(),
    type: "POST",
    success:function(data){
        $("#dni-availability-status").html(data);
        $("#loaderIcon").hide();
        if($('#dni-availability-status span').hasClass('text-danger')){
            $('#btnSubmit').prop('disabled', true);
        }
        else{
            $('#btnSubmit').prop('disabled', false);   
        }
    },
    error:function (){}
    });
}

function checkUserAvailability() {
    var base = "<?php echo BASE_URL;?>";
    var tmpUser = "<?php echo $tmpUser;?>";
    $("#loaderIcon").show();
    jQuery.ajax({
    url: base+"Personas/Verificar/",
    data:'Username='+$("#Username").val(),
    type: "POST",
    success:function(data){
        
        $("#loaderIcon").hide();
        if (tmpUser != $('#Username').val()){
            $("#user-availability-status").html(data);
            if($('#user-availability-status span').hasClass('text-danger')){
                $('#btnSubmit').prop('disabled', true);
            }
            else{
                $('#btnSubmit').prop('disabled', false);   
            }
        }
        
    },
    error:function (){}
    });
}
</script>