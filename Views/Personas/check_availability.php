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
}

?>