<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro</title>
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo BASE_URL;?>Assets/css/LoginStyle.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin" action="<?php echo BASE_URL;?>Usuarios/Guardar">
            <h2 class="form-signin-heading">Registro</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp;Registro exitoso! <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="Username" placeholder="Ingrese un Usuario" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="Email" placeholder="Ingrese un E-Mail" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="Password" placeholder="Ingrese una Contraseña" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Registrarse
                </button>
            </div>
            <br />
            <label>Tengo una cuenta! <a href="<?php echo BASE_URL;?>Usuarios/">Entrar</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>