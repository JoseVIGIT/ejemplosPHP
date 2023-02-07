<?php

   /**
    * Se preparan los datos para enviarse. ARRAY por ser más comodo
    */
   $datos = array(
      nombre=>"miNombre",
      codigo=>"12345"
   );
   
   /**
    * Se codifican los datos en formato JSON (o XML, o lo que fuera)
    * y se monta la cadena para el POST
    */ 
   $datos = ((json_encode($datos)));
   $datosPost = "datos=".$datos;

   /**
    * Mostrando mensajes de aviso previos usando htmlentities para mostrar
    * caracteres especiales
    */ 
   echo "<p>Conectando con servicio...</p>";
   echo "<p>Enviando mensaje:<br/>", htmlentities($datosPost), "</p>";
   
   /**
    * Usando CURL para enviar petición post al servicio
    * Se configura la URL indicando además el formato enviado,
    * se indica que no se desean cabeceras de vuelta,
    * se añaden datos de autenticación (Apache protegido),
    * se indican número de campos a enviar y se añade la cadena de campos,
    * se indica que se debe capturar la respuesta (para volcarla en variable)
    
    * Otra forma de inicializar las cabeceras
    
         $headers = array(
            "POST ".$page." HTTP/1.0",
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: \"run\"",
            "Content-length: ".strlen($xml_data),
            "Authorization: Basic " . base64_encode($credentials)
         ); 
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    */

   $url = "http://localhost/testPHP/SERVICIO/servicio.php";
   $usr_pwd = "josevcs:josevcs";
   // Ejemplo de codificación de usr:pwd durante la emision
   // $usr_pwd = base64_encode("josevcs:josevcs");
   
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);   
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_USERPWD, $usr_pwd);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $datosPost);
   curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
   $respuesta = curl_exec($ch);
   curl_close($ch);

   /**
    * Se muestran los resultados obtenidos tal cual usando htmlentities para
    * mostrar caracteres especiales
    */
   echo "<p>Respuesta desde servicio:<br/><br/>", htmlentities($respuesta), "</p>";

   /**
    * Se genera un XML con la respuesta y se accede a los campos concretos
    * SimpleXML se situa en el primer elemento raiz (usuarios)
    */   
   echo "<p>";
   $xmlRespuesta = new SimpleXMLElement($respuesta);
   echo "Nombre: " . $xmlRespuesta->usuario[0]->nombre . "<br/>";
   echo "Codigo: " . $xmlRespuesta->usuario[0]->codigo . "<br/>";
   echo "Site: " . $xmlRespuesta->usuario[0]->site . "<br/>";
   echo "</p>";

