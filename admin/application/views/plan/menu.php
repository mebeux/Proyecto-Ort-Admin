<div id="menu2">
	<div id="titulo">Planes</div>
	<nav>
		<ul>
			<li><a href="#">Inicio</a></li>
			<li><a href="#">Crear</a></li>
                        <?php if($menu[1]!="inicio"){
                            ?>
                        <li><a href="<?php echo base_url()."plan/ver/".$plan->id?>">Editar</a></li>
                        <?php
                        }
                        ?>
			<li><a href="#">Opción 8</a></li>
		</ul>
	</nav>

</div>
