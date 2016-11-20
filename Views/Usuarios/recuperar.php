<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restablecer Contraseña</title>
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo BASE_URL;?>Assets/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo BASE_URL?>Assets/css/LoginStyle.css" type="text/css"  />
<script src="<?php echo BASE_URL;?>Assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" id="restoreForm" action="<?php echo BASE_URL;?>Usuarios/Restablecer/" method="post">
      
        <h2 class="form-signin-heading">Restablecer Contraseña.</h2><hr />
        
        <div class="form-group">
          <input type="text" class="form-control" name="Username" id="Username" placeholder="Nombre de Usuario" required maxlength="20" />
        </div>
        
        <div class="form-group">
          <input type="email" class="form-control" name="Email" id="Email" placeholder="Email" required />
          <span id="check-correspondence-status"></span>
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

</body>
</html>

<script type="text/javascript">

  $(document).ready(function () {

    $("form").submit(function(event){
      //Check user-email existence
      event.preventDefault();
      var form = this;
      var base = "<?php echo BASE_URL;?>";
      $("#loaderIcon").show();
      jQuery.ajax({
      url: base+"Usuarios/VerificarEmail/",
      data:'Username='+$("#Username").val()+'&Email='+$("#Email").val(),
      type: "POST",
      success:function(data){
          
          $("#loaderIcon").hide();
          $("#check-correspondence-status").html(data);
          if($('#check-correspondence-status p').hasClass('text-success')){
              //$('form').submit();
              //form.submit();
              return true;
          }
          else{
              return false;
              //$('#btnSubmit').prop('disabled', false);   
          }
          
      },
      error:function (){return false;}
        
      });
    });
    
    function checkUserEmailExistence() {
      var base = "<?php echo BASE_URL;?>";
      $("#loaderIcon").show();
      jQuery.ajax({
      url: base+"Usuarios/VerificarEmail/",
      data:'Username='+$("#Username").val()+'&Email='+$("#Email").val(),
      type: "POST",
      success:function(data){
          
          $("#loaderIcon").hide();
          $("#check-correspondence-status").html(data);
          if($('#check-correspondence-status p').hasClass('text-success')){
              //$('form').submit();
              return true;
          }
          else{
              return false;
              //$('#btnSubmit').prop('disabled', false);   
          }
          
      },
      error:function (){return false;}
        
      });
    }
    
  });

  
  
</script>