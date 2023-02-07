<?php

/**
 * 5. Escribe el código necesario para recorrer la estructura de directorios 
 *    de ejer5 y que muestre por pantalla  * un array con todos los ficheros 
 *    (no los directorios) que se encuentran en ella.

		[tvilar@amidala ejer5]$ tree .
		.
		├── bar.txt
		├── foo
		│   └── bar
		│       └── foo
		│           ├── bar.txt
		│           ├── foo
		│           └── foo.txt
		└── foo.txt
	
 *    El resultado debería ser algo como:
			
	 	array(
				0 => 'bar.txt',
				1 => 'foo/bar/foo/bar.txt',
				2 => 'foo/bar/foo/foo.txt',
				3 => 'foo.txt'
		)

 *    El orden no importa, puesto que dependerá de la forma en que se recorran 
 *    los directorios.	
 */	


/* -------------------- */


	/**
	 * Nota del autor:
	 * La función comprueba si la ruta que se da es un directorio para proceder 
	 * a procesarlo o si se ha dado un fichero y devolver únicamente este sin 
	 * tomar más medidas. También puede indicarse una ruta vacía con lo que el 
	 * script devolverá recursivamente y desde . todos los ficheros 
	 * que encuentre	 
	 */
	function ficherosAArray ($filename) {
		if (is_file($filename))
			$respuesta[] = $filename;
		else {
			chdir ($filename);
			$respuesta = array();
			foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.')) as $filename)
			{
				if ($filename->isDir()) continue;
				$respuesta[] = substr($filename->getPathname(),2, strlen($filename->getPathname()));
			}
		}
		return $respuesta;
	}
	
	
	$ruta = 'ejer5';
	$ficheros = ficherosAArray ($ruta);
	print_r ($ficheros);
