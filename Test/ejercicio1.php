<?php

/**
 * 1. Escribe el código necesario para mostrar por pantalla los elementos del
 *    array $a ordenados de mayor a menor y sin elementos repetidos.
 * 
 *    $a = array(2, 1, 1, 0, 5, 3, 2, 1, 4, 4, 2, 5);
 * 
 *    El resultado debería ser: array(5, 4, 3, 2, 1, 0); 
 */
	

/* -------------------- */
	

	function ordenInversoUnico ($datos) {
		sort ($datos, SORT_NUMERIC);
		$datos = array_reverse (array_unique ($datos, SORT_NUMERIC));
		return $datos;
	}
	
	$a = array(2, 1, 1, 0, 5, 3, 2, 1, 4, 4, 2, 5);	
	$ordenado = ordenInversoUnico ($a);
	
	echo "Original: "; print_r ($a); echo "<br/>";
	echo "Ordenado: "; print_r ($ordenado); echo "<br/>";
