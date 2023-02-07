<?php   

   $datos = json_decode($_POST["datos"], true); // true = array asociativo

   $xml = new SimpleXMLElement('<usuarios/>');
   
   /**
    * Añadir una rama nueva (se añade un hijo y nos situamos en el ($usuario)
    * Se invierte clave=>campo a campo=>clave para que el recorrido siguiente
    * funcione bien 
    * Recorrer todo el array de forma recursiva y añadirlo al XML, en este
    * caso al nuevo hijo creado para que se anide.
    * Añadir finalmente un hijo extra al usuario (site)
    */
   $usuario = $xml->addChild('usuario');   
   $datos = array_flip($datos);    

   // recorre $datos y aplica la función addChild del objeto $usuario
   array_walk_recursive($datos, array ($usuario, 'addChild'));   
   
   $usuario->addChild('site', 'wwwtal');
   
   /**
    * Se guarda la respuesta en un fichero y se muestra devuelve el dato
    */
   file_put_contents ("respuesta/respuesta.xml", $xml->asXML());
   echo $xml->asXML();

