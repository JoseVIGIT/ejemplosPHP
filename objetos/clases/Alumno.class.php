<?php

   require_once "Persona.class.php";

   class Alumno extends Persona {
      private $nota;
      function __construct() {
         parent::__construct();
         $this->nota = 0;
      }
      public function setnota ($nota) {
         $this->nota = $nota;
         return ($this->nota);
      }
      public function getnota() {
         return ($this->nota);
      }

   }

