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
                        <?php
                            foreach($planes as $plan) {
                                echo "<li><a href=\"#\" 
                                     class=\"errores-plan\" data-valor=\"{$plan->id}\">
                                     {$plan->nombre}</a></li>\n"; 
                            }
                        ?>
		</ul>
	</nav>

</div>

