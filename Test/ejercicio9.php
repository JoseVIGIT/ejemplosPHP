<?php

/** 
 *  9. Escribe un método (en el lenguaje de programación que prefieras, o en
 *     pseudocódigo) que devuelva cierto si el número que se le pasa como 
 *     parámetro es potencia de 2.
 *     
 *     esPotenciaDe2(4) => TRUE
 */


/* -------------------- */


	/**
	 *  Nota del autor:
	 *  Potencias de 2 son 0,1,2,4,8,16,32,64...
	 *  
	 *    00001
	 *    00010
	 *    00100
	 *    01000 ---- (111...100) en este rango cualquier número anterior al 
	 *    				           preguntado conserva el 1?? por lo que el AND 
	 *                           devolverá algo hasta llegar as 100
	 *    ...
	 *    
	 *  Son en binario valores únicos, sin más 1 que el que representa un valor 
	 *  potencia de 2. Si se hace un AND lógico con el anterior, los bits no 
	 *  coinciden y el resultado será 0 indicando que no es potencia
	 */

	function esPotenciaDe2($valor) {		
		return (($valor > 1) and ($valor & ($valor - 1)) == 0);
	}
	
	$valor = 4;
	echo 'esPotenciaDe2(' . $valor . ') => ' . ((esPotenciaDe2 ($valor))? "TRUE":"FALSE") . "\n";
	$valor = 5;
	echo 'esPotenciaDe2(' . $valor . ') => ' . ((esPotenciaDe2 ($valor))? "TRUE":"FALSE") . "\n";	
	$valor = 1024;
	echo 'esPotenciaDe2(' . $valor . ') => ' . ((esPotenciaDe2 ($valor))? "TRUE":"FALSE") . "\n";				
	
