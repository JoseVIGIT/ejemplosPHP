<?PHP

  session_start();

  $_SESSION[“usuario”] = “yo”;

  header('Location: '.app.php);

