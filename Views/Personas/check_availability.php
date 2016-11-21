<?php
if(!empty($_POST["Username"])) {
  if ($this->model->userExists($_POST["Username"])){
  	echo "<span class='text-danger'> Usuario no disponible.</span>";
  }
  else{
  	echo "<span class='text-success'> Usuario disponible.</span>";
  }
}

if(!empty($_POST["Dni"])) {
  if ($this->model->dniExists($_POST["Dni"])){
  	echo "<span class='text-danger'> Ya existe una persona con este DNI.</span>";
  }
  else{
  	echo "<span class='text-success'> Disponible.</span>";
  }
} else if (isset($_POST["Dni"]))
{
  $dniPost = (string)$_POST["Dni"];
  if ($dniPost=="0")
  {
    if ($this->model->dniExists($dniPost)){
      echo "<span class='text-danger'> Ya existe una persona con este DNI.</span>";
    }
    else {
      echo "<span class='text-success'> Disponible.</span>";
    }  
  }
}

?>