<?php

/**
 * 4. Suponiendo que el fichero ejer4.txt contiene una línea para cada uno de 
 *    los mails que se han enviado en un sistema con todos los campos 
 *    necesarios, escribe el código que inserte esos mails en la tabla 
 *    'emails'. La tabla emails tiene los siguientes campos: 
 * 
 *    'id' (autoincrement), 'sender', 'receiver', 'subject', 'body' y 'status'.
 */
	

/* -------------------- */


	/**
	 * Lectura del fichero. Se devuelve un array donde 
	 * cada línea representa un elemento
	 */
	function leerFichero($filename) {
		return file($filename);
	}
	
	
	/**
	 * Volcado de lineas(registros) a array
	 * Creado de un array asociativo (<nombreCampo> => <valorCampo>) 
	 * partiendo del original para facilitar inserts en BD
	 */
	function lineaTextoAArray ($lineas) {
		$respuesta = [];
		$registros = [];
		$indice = 0;
		
		// Volcado de lineas(registros) a array		
		foreach ($lineas as $linea) {
			$linea = str_replace(array("\r", "\n"), '', $linea);
			$registros[] = explode("#", $linea);
		}

		 // Creando un array asociativo (<nombreCampo> => <valorCampo>)
		foreach ($registros as $registro) {
			foreach ($registro as $campo) {
				$campo = (explode (":",$campo));
				$respuesta[$indice][$campo[0]] = $campo[1];
			}
			$indice++;
		}	
		
		return $respuesta;
	}
	
	
	/**
	 * Lectura del valor de cada campo y generación de consultas + insertado
	 */
	function conecterEInsertar ($respuesta) {		
		// Parametros de configuración de acceso. Modificar según proceda
		$columnas = "";
		$valores = "";		
		$dbname = "test";
		$host = "localhost";		
		$username = "root";
		$password = "pwd";
		$tabla = "emails";
		$gsent = "";
		
		// Charset UTF-8 para empleo de caracteres especiales (acentuadas, etc)
		$conexion = new PDO("mysql:dbname=$dbname;host=$host;charset=utf8", $username, $password);
		
		// Generanco consultas e insertando
		
		// Generación de cabeceras (nombre de campos) para el insert		
		foreach ($respuesta[0] as $key=>$dato)
			$columnas .= "$key, ";		
		$columnas=strtoupper(substr($columnas, 0, strlen($columnas)-2));
		
		// Generando valores de cada fila e insertando datos
		foreach ($respuesta as $registro) {
			
			//Generando valores del registro a intertar
			$valores = "";
			foreach ($registro as $key => $dato) {
				// Aceptar caracteres especiales (comillas, etc)
				$dat = $conexion->quote($dato);
				$valores .= $dat . ", ";
			}			
			$valores = substr($valores, 0, strlen($valores)-2);
			
			// Insertando
			$consulta = "insert into $tabla ($columnas) values ($valores)";
			$gsent = $conexion->prepare($consulta);
			$gsent->execute();
		}
		
		
		$conexion = null;
	}
	
	
	$lineas = leerFichero("ejercicio4.txt");
	$respuesta = lineaTextoAArray ($lineas);
	conecterEInsertar ($respuesta);
