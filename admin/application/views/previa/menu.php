<?php
    $op = isset($menu[1])? strtolower($menu[1]):"";
?>
<div id="menu2">
	<div id="titulo">Previas</div>
	<nav>
		<ul>
			<!--<li <?php if ($op=="inicio") echo " class=\"active\""; ?>>
                            <a href="#">Inicio</a>
                        </li>-->
                        <?php
                            foreach($planes as $plan) {
                                echo "<li class=\"titulo\"><a href=\"#\" 
                                     class=\"errores-plan\" data-valor=\"{$plan->id}\">
                                     <b>{$plan->nombre}</b></a></li>\n";
                                     
                                echo "<li><ul class=\"submenu\">\n
                                            <li><a data-func=\"inscripcion\" data-valor=\"{$plan->id}\" 
                                                    href=\"#\">Errores en inscripción</a></li>
                                            <li><a data-func=\"actas\" data-valor=\"{$plan->id}\" 
                                                    href=\"#\">Errores en actas</a></li>
                                            <li><a data-func=\"posibles\" data-valor=\"{$plan->id}\" 
                                                href=\"#\">Posibles errores</a></li>
                                          </ul>
                                      </li>\n";
                                
                            }
                        ?>
		</ul>
	</nav>

</div>

