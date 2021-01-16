<?php

// PROGRAMA DE MENU ADMINISTRADOR
include "conectar.php";

session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {
  	    $desc_tipo_usuario = "operador";
        if ($_SESSION["tipousuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
    }

?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
          <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
           <title> ITCS Management </title>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	       <script src="https://code.highcharts.com/highcharts.js"></script>
        </head>
       <body>
        <table width="100%"  align=center cellpadding=5 border=0 bgcolor="#2E4053">
    	   <tr>
           <td valign="top" align=left width=70% >
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30% >
                     <img src="../img/sip.png" border=0 width=90 height=90>

             	    </td>
                  <td valign="bottom" align=center width=60%>
                     <h1><font color=#FFFFFF face="Century Gothic">INTELLIGENT TRAFFIC CONTROL SYSTEM</font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right >
              <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><?php  echo "Username</u>:   ".$_SESSION["nombre"];?> </b></font><br>
              <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><?php  echo "User type</u>:   ".$desc_tipo_usuario;?> </b></font><br>
              <button type="button"><font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><a href="cerrar_sesion.php"> Logout </a></b></font></button>

           </td>
	     </tr>
     </table>

    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_usuario.php";
?>
        <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Update data</h1></b></font>


		       </td>

       </tr>
		    </table>
<?php
if ((isset($_POST["enviado"])))
  {
   //echo "save changes modification";
   $id_usu_enc = $_POST["id_usu"];
   $nombre_usuario = $_POST["nombre_usuario"];
   $nombre_usuario = str_replace("�","n",$nombre_usuario);
   $nombre_usuario = str_replace("�","N",$nombre_usuario);
   $apellido_usuario = $_POST["apellido_usuario"];
   $apellido_usuario = str_replace("�","n",$apellido_usuario);
   $apellido_usuario = str_replace("�","N",$apellido_usuario);
   $num_id = $_POST["num_id"];
   $tipo_usuario = $_POST["tipo_usuario"];
   $activo = $_POST["activo"];
   $password = $_POST["password"];
   $login = $_POST["login"];
   
   $sqlu1 = "UPDATE usuario set nombre='$nombre_usuario' where id='$id_usu_enc'";
   $resultsqlu1 = pg_query($conectar,$sqlu1);

   
   $sqlu5 = "UPDATE usuario set apellido='$apellido_usuario' where id='$id_usu_enc'";
   $resultsqlu5 = pg_query($conectar,$sqlu5);

	 $sqlu2 = "UPDATE usuario set nom_usuario='$login' where id='$id_usu_enc'";
   $resultsqlu2 = pg_query($conectar,$sqlu2);
   $sqlu3 = "UPDATE usuario set numero_id='$num_id' where id='$id_usu_enc'";
   $resultsqlu3 = pg_query($conectar,$sqlu3);
   $sqlu7 = "UPDATE usuario set activo='$activo' where id='$id_usu_enc'";
   $resultsqlu7 = pg_query($conectar,$sqlu7);
   if ($password != "")
     {
     $password_enc = md5($password);
     $sqlu9 = "UPDATE usuario set clave='$password_enc' where id='$id_usu_enc'";
     $resultsqlu9 = pg_query($conectar,$sqlu9);
     }
     
   
   if (($resultsqlu1) && ($resultsqlu2) && ($resultsqlu3) &&
       ($resultsqlu5) && ($resultsqlu7))
         header('Location: actualizar_datos.php?mensaje=1');
   else
         header('Location: actualizar_datos.php?mensaje=2');
   
}

else

{
   $id_usu_enc = $_SESSION["id_usuario"];
   $sql1 = "SELECT * from usuario where id='$id_usu_enc'";
   $result1 = pg_query($conectar,$sql1);
   $row1 = pg_fetch_array($result1);
   $nombre_usuario  = $row1[2];
   $apellido_usuario = $row1[3];
   $tipo_usuario  = $row1[1];
   $num_id = $row1[4];
   $activo= $row1[7];
   $login= $row1[5];


   if ($activo == 1)
      $desc_activo = "S (Activo)";
   else
      $desc_activo = "N (Inactivo)";
      
    if ($tipo_usuario == 1){
        $desc_tipo_usuario = "administrador";
    }
    else{
        $desc_tipo_usuario = "operador";
    }

   ?>
   <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
      
  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=0>
                   <tr>
                    <?php 
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >User updated successfully.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >User was not updated correctly.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>";

            }
           }   
            ?>    
	   
   	     <tr>
                  <td colspan=2 width="25%" height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">

                   <form method=POST action="actualizar_datos.php">
                   <table width=50% border=0 align=center>
			    <tr>	
				<td bgcolor="#D1E8FF" align=center> 
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Name</b></font>
				</td>	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=nombre_usuario value="<?php echo $nombre_usuario; ?>" required>
				</td>	
	     </tr>
	     <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Last name</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=apellido_usuario value="<?php echo $apellido_usuario; ?>" required>
				</td>
	     </tr>
	     <tr>
				<td bgcolor="#D1E8FF" align=center> 
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>ID</b></font>
				</td> 	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="number" name=num_id value="<?php echo $num_id; ?>" required>  
				</td>	
			     </tr>

			  <tr>
				<td bgcolor="#D1E8FF" align=center> 
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>User</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=login value="<?php echo $login; ?>" required>  
				</td>	
			  </tr>

			  <tr>
				<td bgcolor="#D1E8FF" align=center> 
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Password (leave blank to not change)</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="password" name=password value="">  
				</td>	
			  </tr>

	     <tr>
				<td bgcolor="#D1E8FF" align=center> 
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Active (Y/N)</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
        <select name=activo required> 
           <option value="<?php echo $activo; ?>"> <?php echo $desc_activo; ?></option>
           <?php
           $activo_con = 1;
           $desc_activo_con = "Y (Active)";
           if ($activo_con != $activo)
               {
           ?>
              <option value="<?php echo $activo_con; ?>"> <?php echo $desc_activo_con; ?></option>
           <?php
               }
           ?>
          </select>

				</td>	
	     </tr>
      </table>

         <input type="hidden" value="S" name="enviado">
         <input type="hidden" value="<?php echo $id_usu_enc; ?>" name="id_usu">
         <table width=50% align=center border=0>
           <tr>  
             <td width=50%></td>                                                                       
             <td align=center><font face="Century Gothic"><input style="background-color: #DBA926" type=submit color= blue value="Modificar" name="Modificar">
                  </font></form>
             </td>  
           </tr>
          </table>
                  </form> 
<br><br><hr>
                  </td>
                </tr>  

<?php
 }
?>

        </table>
        
       </body>
      </html>


   
