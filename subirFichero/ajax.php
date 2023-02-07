<?php

   var_dump($_POST);
   var_dump($_FILES);      
   echo $_POST["nombre"];

   $uploaddir = './upload/';
   $uploadfile = $uploaddir . basename($_FILES['fichero']['name']);

   if (move_uploaded_file($_FILES['fichero']['tmp_name'], $uploadfile)) {
       echo "El archivo es válido y fue cargado exitosamente.\n";
   } else {
       echo "La carga no se realizó debidamente\n";
   }

?>
