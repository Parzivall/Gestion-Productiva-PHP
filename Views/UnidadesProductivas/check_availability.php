<?php
if(!empty($_POST["Nombre"])) {
  if ($this->model->nameExists($_POST["Nombre"])){
  	echo "<span class='text-danger'> Ya existe una Unidad Productiva con ese Nombre.</span>";
  }
  else{
  	echo "<span class='text-success'> Nombre disponible.</span>";
  }
}

?>