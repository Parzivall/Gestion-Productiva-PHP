<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reset Password</title>
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo BASE_URL?>Assets/css/LoginStyle.css" type="text/css"  />
<script src="<?php echo BASE_URL;?>Assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>Assets/css/messages.css">
</head>
<body>

<div class="signin-form">


	<div class="container">

    <?php
      if ($Username=='' && $error=='')
      {
        $error='Ocurrio un error, no se pudo encontrar el usuario, contacte al administrador';
      }
      if ($error!='')
      {
        echo '<div class="error">'.$error.'</div>'; 
      }
    ?>
     <div <?php echo ($error!=''? 'hidden' : '') ?> >
       <form class="form-signin" id="restoreForm" action="<?php echo BASE_URL;?>Usuarios/ChangePassword/" method="post">
      
        <h2 class="form-signin-heading">Ingrese su nueva Contraseña.</h2><hr />
        
        <div class="form-group">
          <input type="password" class="form-control" name="Password" id="Password" placeholder="Ingrese su nueva contraseña" required maxlength="20" />
        </div>
        <input type="text" value="<?php echo $Username;?>" name="Username" hidden></input>
         <input type="text" value="<?php echo $token;?>" name="Token" hidden></input>
        <div class="form-group">
          <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="Vuelva a ingresar su nueva contraseña" required maxlength="20"/>
          <span id="status"></span>
          <p><img src="<?php echo BASE_URL;?>Assets/img/LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
        </div>

      <hr />
        
        <div class="form-group">
            <button type="submit" id="submitButton" name="btn-restore" class="btn btn-default">
                  <i class="glyphicon glyphicon-log-in"></i> &nbsp; Enviar
            </button>
        </div>  
        <!--<br />
            <label>Aun no tienes Cuenta? <a href="<?php echo BASE_URL;?>Usuarios/Registro">Registrese</a></label>-->
      </form>
     </div>
    </div>
    
</div>

</body>
</html>

<script type="text/javascript">

var password = document.getElementById("Password")
  , confirm_password = document.getElementById("ConfirmPassword");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Las contraseñas ingresadas son diferentes!");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

  
  
</script>