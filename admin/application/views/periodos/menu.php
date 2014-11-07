<div id="menu2">
	<div id="titulo">Periodos</div>
	<nav>
		<ul>
			<li><a href="<?php echo base_url()."periodo/index/"?>">Inicio</a></li>
			<li><a href="<?php echo base_url()."periodo/ver/".$actual->periodo?>">Actual</a></li>
			<li><a href="<?php echo base_url()."periodo/crear_formulario/"?>">Crear</a></li>
                        <?php
                        if( $menu[1]=="ver" && $periodo->actual==$periodo->id ){
                            
                       echo " <li><a href=\"".  base_url()."periodo/editar_formulario\">Editar</a></li>";
			}
                        ?>
		</ul>
	</nav>

</div>
