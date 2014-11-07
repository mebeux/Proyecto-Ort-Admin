<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf8" />
	<script type="text/javascript" language="Javascript" src="<?php echo base_url()?>public/js/jquery.js"></script>
	<script type="text/javascript" language="Javascript" src="<?php echo base_url()?>public/js/jquery-ui.min.js"></script>
	<script type="text/javascript" language="Javascript" src="<?php echo base_url()?>public/js/modal.js"></script>
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
			<li <?php if ($op == "usuarios") echo "class=\"active\""; ?>>
                                    <a href="#">Usuarios</a></li>
			<li <?php if ($op == "herramientas") echo "class=\"active\""; ?>>
                            <a href="#">Herramientas</a></li>
                       <!-- 
			<li><a href="#">Opción 7</a></li>
			<li><a href="#">Opción 8</a></li>
			<li><a href="#">Opción 9</a></li>
			<li><a href="#">Opción 10</a></li>-->
		</ul>
</nav>
</div>
<div id="cuerpo">
