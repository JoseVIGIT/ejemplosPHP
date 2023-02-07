<?php

/**
 * 2. Suponiendo que existe una base de datos 'test' con una tabla 'users' con 
 *    los campos: userID , name , country , credits
 *    
 *    Escribe el código necesario para exportar la tabla a un fichero XML con 
 *    el siguiente formato:

		<xml>
			<users>
				<user>
					<userID>userID1</userID>
					<name>name1</name>
					<country>country1</country>
					<credits>credits1</credits>
				</user>
				...
				<user>
					<userID>userIDN</userID>
					<name>nameN</name>
					<country>countryN</country>
					<credits>creditsN</credits>
				</user>
			</users>
		</xml>
				
 */


/* -------------------- */


	/**
	 * No uso SimpleXMLElement porque el formato de XML no es correcto faltando 
	 * la cabecera. Podría emplearse y añadir una cabecera tipo 
	 * <?xml version="1.0"?> pero no quedaría como en el ejemplo propuesto
	 * Se opta por hacer una implementación específica para este tipo de 
	 * fichero XML concreto dando por supuesto que su estructura será siempre 
	 * así	
	 * 		
	 * Ejecutado desde línea de comandos ($php ejercicio2.php) el fichero será 
	 * creado si procede y la información volcada en él.Si se realiza la 
	 * operación desde un navegador habrá que configurar los permisos en el 
	 * servidor para que el fichero pueda ser creado/escrito
	 */			
	

/* -------------------- */


	/**
	 * Conexión y lectura de la tabla
	 */
	function conectarYLeer () {	
		// Parametros de configuración de acceso. Modificar según proceda		
		$host = "localhost";		
		$username = "root";
		$password = "pwd";
		$dbname = "test";
		$tabla = "users";
		$gsent = "";
		$respuesta = [];
	
		// Usar charset UTF-8 para uso de caracteres especiales (tildes, etc)
		$conexion = new PDO("mysql:dbname=$dbname;host=$host;charset=utf8", $username, $password);
		$consulta = "select * from $tabla";
		$gsent = $conexion->prepare($consulta);
		$gsent->execute();
		$respuesta = $gsent->fetchAll(PDO::FETCH_ASSOC);
	
		$conexion = null;
		
		return $respuesta;
	}
	

	/**
	 * A tener en cuenta que al crear la cadena XML, los datos no incluyen 
	 * tabulaciones (\t) ni saltos de línea (\n) Si la información se guarda en 
	 * un fichero y este es visualizado en un lector de XML (p.ej: navegador) 
	 * el formato se representará correctamente
	 */
	function aXML ($datos) {
		$infoXML = "";
		$infoXML = "<xml>";
		$infoXML .= "<users>";
		
		foreach ($datos as $registro) {
			$infoXML .= "<user>";
			foreach ($registro as $campo => $valor)
				$infoXML .= "<$campo>$valor</$campo>";
			$infoXML .= "</user>";
		}
		
		$infoXML .= "</users>";
		$infoXML .= "</xml>";
		
		return $infoXML;	
	}	
	

	$datos = conectarYLeer ();
	$fichero = "ejercicio2.xml";
	$datosXML = aXML ($datos);	
	file_put_contents ($fichero, $datosXML, LOCK_EX);	
