<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf8" />
	<script type="text/javascript" language="Javascript" src="<?php echo base_url()?>public/js/jquery.js"></script>
	<script type="text/javascript" language="Javascript" src="<?php echo base_url()?>public/js/jquery-ui.min.js"></script>
	<script type="text/javascript" language="Javascript" src="<?php echo base_url()?>public/js/estilo.js"></script>
        <?php
        
            if (isset($js)) {
        
                foreach($js as $j) {
                    echo "<script type=\"text/javascript\" language=\"Javascript\" src=\"".
                        base_url()."public/js/$j.js\"></script>\n";    
                }
            }    
        ?>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/css/estilo.css" />
</head>
<body>
<div id="cabecera">
        <?php
            $op = isset($vista[1])? strtolower($vista[1]):"";
        ?>
<nav id="main-menu">
		<ul>
			<li <?php   if ($op == "asignaturas") echo "class=\"active\"";
                                    echo ">".anchor("asignatura/index","Asignaturas"); ?></li>
			<li <?php if ($op == "planes") echo "class=\"active\""; 
                                    echo ">".anchor("plan/index","Planes"); ?></li>
			<li <?php if ($op == "ediciones") echo "class=\"active\""; 
                                    echo ">".anchor("edicion/index","Años lectivos"); ?></li>
			<li <?php if ($op == "periodos") echo "class=\"active\""; 
                                    echo ">".anchor("periodo/index","Períodos de examen"); ?></li>
			<li <?php if ($op == "escala") echo "class=\"active\""; 
                                    echo ">".anchor("escala/index","Escala de notas"); ?></li>
			<li <?php if ($op == "usuarios") echo "class=\"active\""; 
                                    echo ">".anchor("usuario/index","Usuarios"); ?></li>
			<li <?php if ($op == "previas") echo "class=\"active\""; 
                                    echo ">".anchor("previa/index","Previas"); ?></li>
			<li <?php if ($op == "salir") echo "class=\"active\""; ?>>
                            <a href="#">Salir</a></li>
		</ul>
</nav>
</div>
<div id="cuerpo">
