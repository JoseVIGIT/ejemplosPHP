<!doctype html>
<html>
<head></head>
<body>

   <form enctype="multipart/form-data" id="datos">
      <label>Nombre</label>
      <input name="nombre" type="text" value="elnombre" />
      <br />
      <label>Fichero</label>
      <input id="fichero" name="fichero" type="file" />
      <br />
      <input type="button" name="enviar" onclick="enviarFrm()" value="enviar" />
   </form>

   <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

   <script>

      function enviarFrm () {

         var frmDatos = new FormData ($("#datos")[0]);

         $.ajax({
            url: "ajax.php",
            type: "POST",
            data: frmDatos,
            processData: false,
            contentType: false
         }).success(function(datosAJAX){
            console.log (datosAJAX);
         });
      
         return false;

      };

   </script>

</body>
</html>
