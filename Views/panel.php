<div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo isset($_SESSION['Unidad_Id']) ? 'Unidad Productiva: '.$_SESSION['UnidadNombre'] : ''; ?></a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        
                        <li>
                           <a href="<?php echo BASE_URL;?>Personas/Crud/<?php echo isset($_SESSION['UserDni']) ? $_SESSION['UserDni'] : ''?>">
                               Perfil
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo BASE_URL;?>Usuarios/Logout/">
                                Salir
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>