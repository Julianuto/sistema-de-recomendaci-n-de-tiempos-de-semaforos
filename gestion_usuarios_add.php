<?php
include "conectar.php";

session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {
  	    $desc_tipo_usuario = "administrador";
        if ($_SESSION["tipousuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
          <link rel="stylesheet" href="css/estilos_virtual.css" 			type="text/css">
           <title>Gestion cruce</title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#2E4053">
         <tr>
           <td valign="top" align=left width=70% >
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30% >
                     <img src="../img/sip.png" border=0 width=90 height=90>

             	    </td>
                  <td valign="bottom" align=center width=60%>
                     <h1><font color=#FFFFFF face="Century Gothic">SISTEMA DE CONTROL DE TRÁFICO INTELIGENTE</font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right >
              <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre"];?> </b></font><br>
              <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>
              <button type="button"><font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><a href="cerrar_sesion.php"> Cerrar Sesion </a></b></font></button>

           </td>
	     </tr>
<table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_admin.php";


if ((isset($_POST["enviado"])))
  {
   //echo "grabar cambios modificaci�n";
   $tipo_usu = $_POST["tipo_usu"];
   $nombre_usuario = $_POST["nombre"];
   $nombre_usuario = str_replace("�","n",$nombre_usuario);
   $nombre_usuario = str_replace("�","N",$nombre_usuario);
   $apellido_usuario = $_POST["apellido"];
   $apellido_usuario = str_replace("�","n",$apellido_usuario);
   $apellido_usuario = str_replace("�","N",$apellido_usuario);
   $num_id = $_POST["num_id"];
   $login = $_POST["login"];
   $activo = $_POST["activo"];
   $password = $_POST["password"];
   $password_enc = md5($password);
   $sqlcon = "SELECT * from usuario where numero_id='$num_id'";
   echo $sqlcon;
   $resultcon = pg_query($conectar, $sqlcon);
   $rowcon = pg_fetch_array($resultcon);
   $numero_filas = pg_num_rows($resultcon);
  
   if ($numero_filas > 0)
     { 
     
         header('Location: gestion_usuarios.php?mensaje=5');
     }
   else
    {
      $sql = "INSERT INTO usuario(tipo_usu, nombre, apellido, numero_id, nom_usuario, clave,activo)
      VALUES ('$tipo_usu','$nombre_usuario','$apellido_usuario','$num_id','$login','$password_enc','$activo')";
      $result1 = pg_query($conectar, $sql);
      
      if ($result1) 
        {
          header('Location: gestion_usuarios.php?mensaje=3');
        }
      else
         header('Location: gestion_usuarios.php?mensaje=4');
      
    }
}

else

{

   ?>
	
    <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Agregar usuario</h1></b></font>
		       </td>

    </tr>

    <tr>
        <td colspan=2 width="25%" height="20%" align="left" 				
          bgcolor="#FFFFFF" class="_espacio_celdas"
          style="color: #FFFFFF; 
          font-weight: bold">

          <form method=POST action="gestion_usuarios_add.php">
          <table width=50% border=0 align=center>
          <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Tipo Usuario</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
          <select name=tipo_usu required>   
            <option value="2"> Operador</option>  
            <option value="1"> Administrador</option>
          </select>
				</td>	
	     </tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Nombre</b></font>
				</td>	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=nombre value="" required>
				</td>	
       </tr>
         <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Apellido</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=apellido value="" required>
				</td>
			     </tr>
	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Numero ID</b></font>
				</td> 	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="number" name=num_id value="" required>  
				</td>	
			     </tr>

	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Usuario</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=login value="" required>  
				</td>	
	     </tr>

	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Clave</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="password" name=password value="" required>  
				</td>	
	     </tr>

	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Activo (S/N)</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
          <select name=activo required> 
            <option value="1"> S (Activo)</option>  
            <option value="0"> N (Inactivo)</option>  
          </select>
				</td>	
	     </tr>
	          <input type="hidden" value="S" name="enviado">
         <table width=50% align=center border=0>
           <tr>
             <td width=50%></td>
             <td align=center><input type=submit color= blue value="Grabar" name="Modificar">
                  </form>
             </td>
             <td align=left>
                  <form method=POST action="gestion_usuarios_add.php">
                  <input  type=submit color= blue value="Volver" name="Volver">
                  </form>
             </td>
           </tr>
      </table>

<?php
 }
?>

        
       </body>
      </html>


   
