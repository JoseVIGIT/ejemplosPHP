<?php

   /** Encriptado usando BLOWFISH y CRYPT
       $2y$ en la cabecera permite más de 8 digitos en pwd
       cost define el tiempo FIJO para la generación de hash
       La función crypt es una función de encriptado has unidireccional
       No se podrá desencriptar la contraseña teniendo que aplicar métodos
       de fuerza bruta con diccionarios extensos
    */

   // Comprobando módulo de encriptación
   if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {      

      // Datos de prueba. $pwdEncriptada sería el dato a guardar en BD
      $pwd = "prueba"; // contraseña en formato plano
      $pwdIncorrecta = "abc";
      $pwdEncriptada = password_hash(($pwd), PASSWORD_BCRYPT, array('cost' => 12));
      
      // Mostrar resultados
      echo "Clave de ejemplo: " . $pwd . "<br/>" . PHP_EOL;
      echo "Clave encriptada: " . $pwdEncriptada . "<br/>" . PHP_EOL;
      echo "Comparando clave de ejemplo con clave encriptada: ";
      if (password_verify($pwd, $pwdEncriptada))
         echo "OK";   
      else
         echo "ERROR";
      echo PHP_EOL . "<br/>" . "Comparando clave erronea ('$pwdIncorrecta') con clave encriptada: ";
      if (password_verify($pwdIncorrecta, $pwdEncriptada))
         echo "OK";   
      else
         echo "ERROR";   
      echo PHP_EOL . "<br/>" . "Fin";
      echo PHP_EOL . "<br/>";

   } else {
      echo "No existe encriptador esperado";
      exit;
   }

