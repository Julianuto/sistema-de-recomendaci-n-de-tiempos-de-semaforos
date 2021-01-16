                                                       
<?php

// PROGRAMA DE VALIDACION DE USUARIOS
                                                            
$login = $_POST["login1"];
$passwd = $_POST["passwd1"];

$passwd_comp = md5($passwd);
session_start();
include ("conectar.php");

$result1 = pg_query($conectar, "SELECT * from usuario where NOM_USUARIO = '$login' and activo='1'");
$row1 = pg_fetch_array($result1, 0, PGSQL_NUM);
$numero_filas = pg_num_rows($result1);
if ($numero_filas > 0){
    $passwdc = $row1[6];

    if ($passwdc == $passwd_comp){
        $_SESSION["autenticado"]= "SIx3";
        $tipo_usuario = $row1[1];
        $nombre_usuario = $row1[2];
	    if ($row1[1] == 1){
            $desc_tipo_usu = "administrador";
        }
        else{
            $desc_tipo_usu = "operador";
        }
        $_SESSION["tipousuario"]= $desc_tipo_usu;
        $_SESSION["nombre"]= $nombre_usuario;
        $_SESSION["id_usuario"]= $row1[0]; 
        
        if ($tipo_usuario == 1)
            header("Location: gestion_usuarios.php");
        else
            header("Location: tabla_sem_usuario.php");
    }
    else{
      header('Location: index.php?mensaje=1');
    }
}
else
  {
    header('Location: index.php?mensaje=2');
 }  
?>
