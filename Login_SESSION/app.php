<?PHP

  session_start();

  if ($_SESSION[“usuario”] != “yo”)

     header('Location: '.login.php)

  else

     // entrar web

