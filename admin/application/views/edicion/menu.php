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
                                     
                                echo "<li><ul class=\"submenu\">\n";
                                      ?>     
                                
                                <li><a data-plan="<?php echo $plan->id ?>" href="<?php echo base_url()."edicion/ver_anios_por_plan/". $plan->id?>">Inicio</a></li>
			<li><a data-plan="<?php echo $plan->id ?>" href="#">Crear</a></li>
                        <?php if($menu[1]!="inicio"){
                            ?>
                        <li><a data-plan="<?php echo $plan->id ?>" href="<?php echo base_url()."plan/ver/".$plan->id?>">Editar</a></li>
                        <?php
                        }
                        ?>
                                <?php
                                echo "</ul>
                                      </li>\n";
                                
                            }
                        ?>
		</ul>
	</nav>

</div>
