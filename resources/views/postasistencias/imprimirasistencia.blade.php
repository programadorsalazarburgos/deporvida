<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
	         table {
	         border: 1px solid black;
	         border-collapse: collapse;
	      }
	      label{
	         font-weight: bold;
	      }
	      </style>
		<title>Imprimir Asistencia</title>
	</head>
	<body onload="window.print()">
		<img src="http://localhost:8000/images/BANNER.png" width="100%">
		<h2>Registro de asistencia</h2>
		<h4>Codigo: {{$codigo_grupo}}</h4>
		<h4>Escenario: {{$Escenario}}</h4>
		<h4>Disciplina: {{$disciplina}}</h4>
		<?= html_entity_decode($table);?>
	</body>
</html>