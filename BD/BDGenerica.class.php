<?php

	/**
	 * Implementa el interfaz BD
	 * No definen en esta clase los parámetros de conexión
	 * Los parámetros de conexión se definirán en los constructores de las clases que extienda esta clase
	 * de ese modo se podrá generalizar la conexión desde aquí y se obtiene una clase capaz de conectar
	 * con cualquier BD dependiendo únicamente del constructor y los parámetros que vendrán dados en la clase
	 * que extienda a BDGenerica
	 */

	require_once ("BD.class.php");
	require_once ("ResultadoConsulta.class.php");
	
	class BDGenerica implements BD {
		private 
			$conexion = null,
			$resultadoConsulta = null;
		protected 
			$dbname = "",
			$host ="",
			$port = "",
			$username = "",
			$password = "";
	
		/**
		 * Se crea la clase que contendrá los resultados dentro del contructor de la Generica
		 * TODO: Actualmente la clase se crea dentro en el constructor. No se contemplan cambios sobre la información que se devuelve 
		 * Idealmente debería inyectarse en el constructor. La idea sería poder redefinir la clase de resultadoConsulta de forma que 
		 * pudiera devolver una serie de datos definibles.
		 * A tener en cuenta las consecuencias sobre los que hacen uso de esta respuesta (tratar qué datos y cómo) y la visitibilidad
		 * de las propiedades dentro de la clase resultadoConsulta que se tuviera caso de modificarse. 		 
		 * 
		 * 		function __construct ($resultadoConsulta) {
		 *			$this->resultadoConsulta = $resultadoConsulta
		 *		}
		 */
			
		function __construct() {
			$this->resultadoConsulta = new ResultadoConsulta ();
		}
		
		function __destruct() {
			$this->conexion = null;
		}
		
		public function conectar () {
			$this->conexion = new PDO("pgsql:dbname=$this->dbname;host=$this->host;port=$this->port", $this->username, $this->password);
		}
		
		public function desconectar () {
			// Se puede llamar a esta función para forzar la destrucción de la conexión. No obstante el destructor de la clase ya contempla la llamada
			$this->conexion = null;
		}	
	
		public function ejecutarConsulta ($consulta="", $vargs="") {			
			$gsent = $this->conexion->prepare($consulta);
			($vargs)? $gsent->execute($vargs) : $gsent->execute();			 
			$this->resultadoConsulta->cambios = $gsent->rowCount();
			$this->resultadoConsulta->datos = $gsent->fetchAll(PDO::FETCH_ASSOC);
			
			// TODO: Actualmente no se inicializa la propiedad "$this->resultadoConsulta->datos->resultado".
			// $this->resultadoConsulta->datos->resultado = ($vargs)? $gsent->execute($vargs) : $gsent->execute();
			
			return $this->resultadoConsulta;
		}
	}
