<?php

   require_once "Humano.iface.php";

   class Persona implements Humano {
      private $nombre;
      private $edad;
      function __construct() {
         $this->nombre = "";
         $this->edad = 0;
      }
      public function setNombre ($nombre) {
         $this->nombre = $nombre;
         return ($this->nombre);
      }
      public function setEdad ($edad) {
         $this->edad = $edad;
         return ($this->edad);
      }
      public function getNombre () {
         return ($this->nombre);
      }
      public function getEdad () {
         return ($this->edad);
      }
   }

