<?php
  if(!empty($_POST["Username"]) && !empty($_POST["Email"])) {
    if (!$this->model->userEmailExists($_POST["Username"], $_POST["Email"])){
      echo "<p class='text-danger'> No se encontro una correspondencia entre el Usuario y el Email ingresados.</p>";
    }
    else{
      $username = $_REQUEST['Username'];
      $email = $_REQUEST['Email'];
      $token = sha1(uniqid($username, true));
      $verificacion = $this->model->addToken($username, $token);
      if ($verificacion)
      {
        if ($this->enviarLinkRestablecimiento($email, $username,$token))
        {
          echo "<p class='text-success'> Se Envio al correo un enlace para restablecer su contraseña.</p>";  
        } else {
          echo "<p class='text-warning'> No se pudo enviar el enlace, intentelo más tarde.</p>";  
        }
        
      }
      else {
        echo "<p class='text-danger'> Ocurrio un error en la base de datos, contacte al administrador.</p>";
      }
    }
  }
  else if (empty($_POST["Username"])) {
      echo "<p class='text-warning'> Ingrese su Usuario </p>";
      # code...
  }
  else if (empty($_POST["Email"]))
  {
      echo "<p class='text-warning'> Ingrese el correo con el que fue registrado </p>";
  }
  else
  {
    echo "<p class='text-warning'> Excepcion no controlada </p>";
  }
?>