                                                       
<?php

// PROGRAMA DE FINALIZACION DE SESION
                   
  session_start();
  unset($_SESSION["nombre"]);
  unset($_SESSION["tipousuario"]);
  unset($_SESSION["autenticado"]);
  session_destroy();
  header('Location: index.php');
?>
