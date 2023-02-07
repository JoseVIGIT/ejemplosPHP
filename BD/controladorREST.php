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
		$param = "";
		$url = $_SERVER['REQUEST_URI'];
		$accion = $_SERVER['REQUEST_METHOD'];
		
		// Lectura del valor desde el XML. Valor del elemento que ocupa la posicion del indice cuya etiqueta es USUARIO		
		$param = $_REQUEST["datos"];
		if ($param !="") {
			$p = xml_parser_create();
			xml_parse_into_struct($p, $param, $vals, $index);
			xml_parser_free($p);
			
			/**
			 * Convertir XML en array asociativo. Las etiquetas se convierten a mayuscula con formato :<etiqueta>
			 * Esta conversión no tiene en cuenta anidaciones
			 */ 
			foreach ($vals as $etiqueta) {
				$et = ":" . strtolower($etiqueta[tag]);
				$valor = $etiqueta[value];
				$parametros[$et] = $valor;
			}
			$param = $parametros;
		}
		
		switch ($accion) {
			case "GET":
				/**
				 * Si no llegan parametros es un select sin where
				 * si llegan parametros es un select con where 
				 */ 
				if ($param == "")
					$query = "select * from usuariopwd";				
				else {
					
					/**
					 *  Se toman unicamente los parametros que se usan en el where.
					 *  En este ejemplo, para probar, el XML tiene varios parametros y por eso es necesario este paso 
					 *  En la realidad recibiría un XML con lo que se necesita y nada más  
					 */					
					$param = array (":usuario" => $param[":usuario"]);
					
					$query = "select * from usuariopwd where usuario = :usuario";
				}
				break;							
				
			case "POST":
				$query = "insert into usuariopwd values ('Usuario9', 'clave9')";				
				break;
				
			case "PUT":
				$query = "update usuariopwd set usuario = 'Usuario10' where usuario = 'Usuario9'";				
				break;
				
			case "DELETE":
				$query = "delete from usuariopwd where usuario = 'Usuario10'";				
				break;
		}

		echo "REST :<br/>METODO - $accion<br />URI - $url<br/>";
		echo "SQL: $query<br/>";
		echo "PARAM: "; print_r ($param); echo "<br/>";
		echo "<br/>";
		echo "<hr>";
		echo "<br/>";
		$resultado = $listado->ejecutarConsulta($query, $param);
		echo "Datos leidos: ";
		print_r (json_encode($resultado->datos));
		echo "<br/><br/>";
		echo "Total datos afectados: " . $resultado->cambios;
		
		$listado->desconectar ();
		
	?>		
	
</body>
</html>
