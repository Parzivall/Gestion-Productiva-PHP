<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo BASE_URL?>Assets/css/LoginStyle.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" action="<?php echo BASE_URL;?>Usuarios/Login/" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Bienvenido, por favor identifiquese.</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="Username" placeholder="Nombre de Usuario" required maxlength="20" />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="Password" placeholder="Contraseña" required maxlength="20" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Entrar
            </button>
        </div>  
      	<!--<br />
            <label>Aun no tienes Cuenta? <a href="<?php echo BASE_URL;?>Usuarios/Registro">Registrese</a></label>-->
      </form>

    </div>
    
</div>

</body>
</html>