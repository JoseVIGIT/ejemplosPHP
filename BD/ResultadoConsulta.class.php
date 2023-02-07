<?php

	/**
	 * Clase empleada para guardar la respueta de las consultas
	 * La clase almacenará el resultado de la operación (por hacer), el conjunto de datos devueltos y el número de filas afectadas
	 * IMPORTANTE: Se usa a modo de estructura accesible, esto es, se le da caracter publico a las propiedades de la clase.
	 * En un caso más elaborado la clase implementaría set/get para cada propiedad y se haría uso de ello para encapsular más
	 * los elememtos convirtiendo las propiedades a tipo privado
	 */

	class ResultadoConsulta {
		public
			$datos = null, // conjunto de datos devuelto
			$cambios = 0, // número de filas afectadas por posible cambio (insert, delete, update)
			$resultado = false;  // resultado de la operación. TRUE datos / FALSE modificaciones
			
		/**
		 * Constructor. No se realiza inicialización
		 */
		public function __construct ()
		{			
		}
		
		public function __destruct()
		{			
		}
		
		/**
		 * Devuelve las filas afectadas por algún cambio en la consulta. -1 si no hay cambios o se devuelven datos
		 */
		public function cambios () 
		{
			return $this->cambios;
		}
		
		/**
		 * Devuelve el conjunto de datos seleccionados por una consulta
		 */
		public function datos ()
		{
			return $this->datos;
		}
		
		/**
		 * Indica si se trata de una modificación o una consulta. TRUE si devuelve datos, FALSE si no devuelve datos		 
		 */
		public function resultado ()
		{
			return $this->resultado;
		}	
	}