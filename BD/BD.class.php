<?php

	/**
	 * Interfaz con contrato de operaciones básicas sobre una BD cualquiera
	 */
	
	interface BD
	{
		public function conectar ();
		public function desconectar ();
		public function ejecutarConsulta ($consulta, $parametros);
	}
