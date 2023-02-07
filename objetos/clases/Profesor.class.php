<?php

   require_once "Persona.class.php";

   class Profesor extends Persona {
   private $asignatura;
   function __construct() {
      parent::__construct();
      $this->asignatura = "";
   }
   public function setAsignatura ($asig) {
      $this->asignatura = $asig;
      return ($this->asignatura);
   }
   public function getAsignatura () {
      return ($this->asignatura);
   }
   }

