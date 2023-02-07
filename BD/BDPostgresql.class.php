<?php

	/**
	 * Extiende la clase BDGenerica usando el constructor para definir los datos de conexión 
	 */

	require_once ("BDGenerica.class.php");
	
	class BDPostgresql extends BDGenerica {
		function __construct() {
			$this->dbname = "pruebas";
			$this->host ="localhost";
			$this->port = "5433";
			$this->username = "postgres";
			$this->password = "postgres";
		}		
	}
