<?php
    $op = isset($menu[1])? strtolower($menu[1]):"";
?>
<div id="menu2">
	<div id="titulo">Previas</div>
	<nav>
		<ul>
			<li <?php if ($op=="inicio") echo " class=\"active\""; ?>>
                            <a href="#">Inicio</a>
                        </li>
			<li><a href="#">Crear</a></li>
			<li><a href="#">Opción 7</a></li>
			<li><a href="#">Opción 8</a></li>
		</ul>
	</nav>

</div>
