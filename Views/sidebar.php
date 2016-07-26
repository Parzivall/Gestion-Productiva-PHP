<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="<?php echo BASE_URL;?>Assets/img/unsa.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?php echo BASE_URL;?>Home" class="simple-text">
                    Sistema de Gestion Productiva
                </a>
            </div>

            <ul class="nav">
                <li class="<?php echo isset($unidad) ? 'active' : ''?>">
                    <a href="<?php echo BASE_URL;?>UnidadesProductivas">
                        <i class="pe-7s-graph"></i>
                        <p>Unidades Productivas</p>
                    </a>
                </li>
                <li class="<?php echo isset($persona) ? 'active' : ''?>">
                    <a href="<?php echo BASE_URL;?>Personas">
                        <i class="pe-7s-user"></i>
                        <p>Personal</p>
                    </a>
                </li>
                <li class="<?php echo isset($responsable) ? 'active' : ''?>">
                    <a href="<?php echo BASE_URL;?>Responsables">
                        <i class="pe-7s-add-user"></i>
                        <p>Asignaciones</p>
                    </a>
                </li>
                <li class="<?php echo isset($directorio) ? 'active' : ''?>">
                    <a href="<?php echo BASE_URL;?>Directorio">
                        <i class="pe-7s-note2"></i>
                        <p>Directorio</p>
                    </a>
                </li>
                <li class="<?php echo isset($operacion) ? 'active' : ''?>">
                    <a href="<?php echo BASE_URL;?>Operaciones">
                        <i class="pe-7s-cash"></i>
                        <p>Operaciones</p>
                    </a>
                </li>
                <li class="<?php echo isset($cronograma) ? 'active' : ''?>">
                    <a href="<?php echo BASE_URL;?>Cronogramas">
                        <i class="pe-7s-clock"></i>
                        <p>Cronogramas</p>
                    </a>
                </li>
                <li class="<?php echo (isset($ciudad) || isset($rubro) || isset($cargo)) ? 'active' : ''?>">
                    <a href="<?php echo BASE_URL;?>Ciudades">
                        <i class="pe-7s-id"></i>
                        <p>Tablas Auxiliares</p>
                    </a>
                </li>

                
                <!--
                <li>
                    <a href="notifications.html">
                        <i class="pe-7s-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                -->
            </ul>
    	</div>
    </div>
