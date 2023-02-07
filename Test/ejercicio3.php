<?php

/**
 * 3. Escribe el código necesario para parsear el XML del ejercicio anterior y 
 *    mostrar el contenido en forma de array por pantalla.
 */


/* -------------------- */

		
	/**
	* Lectura del fichero. Se devuelve en única cadena de texto 
	* sin saltos de línea
	*/
	function leerFicheroXML($filename) {
		return implode("", file($filename));		
	}
	
	
	/**
	 * Se define una solución concreta para la estructura propuesta, NO genérica 
	 * y NO para cualquier tipo de ramas en orden indeterminado.
	 * Teniendo en cuenta la estructura
	 * 
	 *    <USERID>..</USERID> // supongo que es obligatorio y siempre aparece
	 *    <NOMBRE>..</NOMBRE>
	 *    ...
	 * Hare los calculos a partir de esta etiqueta siendo su posicion inicial
	 * la referencia para localizar el resto de etiquetas del usuario
	 */
	function XMLaArray ($datos) {
		$registro = 0;
		$respuesta = array ();
		
		$parserXML = xml_parser_create();				
		xml_parse_into_struct($parserXML, $datos, $valores, $indice);
		xml_parser_free($parserXML);
		
		foreach ($indice["USERID"] as $posicion) {
			$respuesta[$registro]["USERID"] = $valores[$posicion]["value"];
			$respuesta[$registro]["NAME"] = $valores[$posicion+1]["value"];
			$respuesta[$registro]["COUNTRY"] = $valores[$posicion+2]["value"];
			$respuesta[$registro]["CREDITS"] = $valores[$posicion+3]["value"];
			$registro++;			
		}
		
		return ($respuesta);
	}
	
	
	/**
	 * Debe ejecutarse correctamente ejercicio2.php para crear el XML necesario si
	 * no existe aún
	 */	  
	$datos = leerFicheroXML("ejercicio2.xml");
	print_r (XMLaArray ($datos));
	