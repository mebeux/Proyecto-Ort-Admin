<div id="menu2">
	<div id="titulo">Planes</div>
	<nav>
		<ul>
			<li><a href="<?php echo base_url()."plan/index/"?>">Inicio</a></li>
			<li><a href="#">Crear</a></li>
                        <?php if($menu[1]!="inicio"){
                            ?>
                        <li><a href="<?php echo base_url()."plan/ver/".$plan->id?>">Editar</a></li>
                        <?php
                        }
                        ?>
			
		</ul>
	</nav>

</div>
