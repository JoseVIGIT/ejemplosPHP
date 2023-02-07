<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
</head>
<body>

	<?php	
	
		require_once ("BDPostgresql.class.php");
				
		$listado = new BDPostgresql();	
		$listado->conectar();
		
		$resultado = "";
		$query = "";
		$url = $_SERVER['REQUEST_URI'];
		$accion = $_REQUEST["accion"];
		$param = $_REQUEST["datos"];
		
		switch ($accion) {
			case "verTodo":
				$query = "select * from usuariopwd";				
				break;
			case "verUsuario":
				$query = "select * from usuariopwd where usuario = :usuario";				
				break;				
			case "insert":
				$query = "insert into usuariopwd values ('Usuario9', 'clave9')";
				break;
			case "update":
				$query = "update usuariopwd set usuario = 'Usuario10' where usuario = 'Usuario9'";
				break;
			case "delete":
				$query = "delete from usuariopwd where usuario = 'Usuario10'";
				break;
		}
		
		echo "JSON :<br />METODO - $accion<br />URI - $url<br />";
		echo "SQL: $query<br/>";
		echo "PARAM: "; print_r ($param); echo "<br />";
		echo "<br />";
		echo "<hr>";
		echo "<br />";
		$resultado = $listado->ejecutarConsulta($query, $param);
		echo "Datos leidos: ";
		print_r (json_encode($resultado->datos));
		echo "<br><br>";
		echo "Total datos afectados: " . $resultado->cambios;
		
		$listado->desconectar ();
		
	?>
	
</body>
</html>
