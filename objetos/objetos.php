<?php

   require_once "clases/Humano.iface.php";
   include "clases/Profesor.class.php";
   include "clases/Alumno.class.php";
   
   function mostrarDatos (Humano $humano) {
      echo ("Nombre: " . $humano->getNombre() . "<br />");
      echo ("Edad: " . $humano->getEdad() . "<br />");
      switch (true) {
         case ($humano instanceof Profesor):
            echo ("Materia: " . $humano->getAsignatura() . "<br />");
            break;
         case ($humano instanceof Alumno):
            echo ("Nota: " . $humano->getNota() . "<br />");
            break;
      }
   }

   $profesor = new Profesor();
   $profesor->setNombre ("Carles Munyoz Aldaba");
   $profesor->setAsignatura ("Habilidades sociales");
   $alumno = new Alumno();
   $alumno->setNombre ("Inma Juan Sancho");
   $alumno->setEdad (32);
   $alumno->setNota (7);

   mostrarDatos ($profesor);
   echo ("<br/>");
   mostrarDatos ($alumno);


