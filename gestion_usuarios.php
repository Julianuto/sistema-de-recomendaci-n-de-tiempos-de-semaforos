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
  	  $desc_tipo_usuario = "administrador";
      if ($_SESSION["tipousuario"] != $desc_tipo_usuario)
      header('Location: index.php?mensaje=4');
    }

?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
       <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
           <title>Gestion de usuarios</title>
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
     </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_admin.php";
?>
        <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			            <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Gestion de usuarios</h1></b></font>


		         </td>

       </tr>
		    </table>
        <center>
      <tr>
             <td align=center>
        <form action="gestion_usuarios.php" method="POST" align=center>
          <tr>
           <td align=center >
             <font FACE="Century Gothic" SIZE=2 color="#000000">Identificacion: <input type="number" name=id_con value=""></font>  &nbsp&nbsp&nbsp

             <font FACE="Century Gothic" SIZE=2 color="#000000">Nombre: <input type="text" name=nombre_con value=""></font>            &nbsp&nbsp&nbsp
           </td>
          </tr>



          <tr>
           <td width=50%>
             <font FACE="Century Gothic" SIZE=2 color="#000000">Estado Usuario:
             <select name=estado>
             <?php
             if (isset($_POST["estado"]))
              {
                $estado = $_POST["estado"];
                 if ($_POST["estado"]!="")
                  {  
                    if ($estado == "2")
                     {
                      echo "<option value=".$estado."> Todos los Usuarios</option>";
                      echo "<option value=1> Usuarios solo Activos</option>";
                      echo "<option value=0> Usuarios solo Inactivos</option>";
                     }
                    else if ($estado == "1")
                     {
                      echo "<option value=".$estado."> Usuarios solo Activos</option>";
                      echo "<option value=2> Todos los Usuarios</option>";
                      echo "<option value=0> Usuarios solo Inactivos</option>";
                     }
                    else if ($estado == "0")
                     { 
                      echo "<option value=".$estado."> Usuarios solo Inactivos</option>";
                      echo "<option value=2> Todos los Usuarios</option>";
                      echo "<option value=1> Usuarios solo Activos</option>";
                     }
                  }  
               }
              else
               {
                 ?>
                  <option value=2> Todos los Usuarios</option>
                  <option value=1> Usuarios solo Activos </option>
                  <option value=0> Usuarios solo Inactivos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
              <?php
               }
              ?>  
              </select> &nbsp&nbsp&nbsp

           <td align=center width=50%>
             <font FACE="Century Gothic" SIZE=2 color="#000000"><input type="submit" name=Consultar value="Consultar"></font>      <br>
           </td>
          </tr> </td>   <br>

          <input type="hidden" value="1" name="enviado">
         </form>
        </td>
      </tr>
      </center>

      
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
                    style=color: #000000; font-weight: bold >Usuario actualizado correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue actualizado correctamente.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario creado correctamente.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Se present� un inconveniente";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Ya existe usuario con la misma c�dula.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>";

            }
           }   
            ?>                         

	  	     <tr>
                  <td colspan=2 height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">

     <table width=80% border=0 align=center>
			 <tr>	
				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Nombre</b></font>
				</td>	
				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Apellido</b></font>
				</td> 	
				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>ID</b></font>
				</td> 	
				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Usuario</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Tipo de usuario</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Activo (S/N)</b></font>
				</td>
   	    <td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Modificar</b></font>
				</td>
			</tr>
				  
<?php
		     if ((isset($_POST["enviado"])))
         {
           $id_con = $_POST["id_con"];
           $nombre_con = $_POST["nombre_con"];
           $estado = $_POST["estado"];
           $sql1 = "SELECT * from usuario order by nombre";
           if (($id_con == "") and ($nombre_con == ""))
             {
              if ($estado != "2")
                $sql1 = "SELECT * from usuario where activo='$estado' order by nombre";
             }
           if (($id_con != "") and ($nombre_con == ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuario where numero_id='$id_con'";
              else
                $sql1 = "SELECT * from usuario where numero_id='$id_con' and activo='$estado'";
             }
           if (($id_con == "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuario where nombre ILIKE '%$nombre_con%' order by nombre";
              else
                $sql1 = "SELECT * from usuario where nombre ILIKE '%$nombre_con%' and activo='$estado' order by nombre";
              }
           if (($id_con != "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                 $sql1 = "SELECT * from usuario where nombre ILIKE '%$nombre_con%' and numero_id='$id_con'";
              else
                $sql1 = "SELECT * from usuario where nombre ILIKE '%$nombre_con%' and numero_id='$id_con' and activo='$estado'";
             }      
          }
         else
             $sql1 = "SELECT * from usuario order by nombre";
             
         //echo "sql1 es...".$sql1;
         $result1 = pg_query($conectar, $sql1);
         while($row1 = pg_fetch_array($result1))
         {
			    $id_usu  = $row1[0];
			    $id_usu_enc = md5($id_usu);
			    $nombre_usuario  = $row1[2];
          $apellido_usuario  = $row1[3];
	     	  $num_id = $row1[4];
	     	  $usuario= $row1[5];
          $tipo_usuario  = $row1[1];
	     	  $activo= $row1[7];
			    if ($activo == 1)
				    $desc_activo = "S";
			    else
				    $desc_activo = "N";
          if ($tipo_usuario == 1){
              $desc_tipo_usuario = "administrador";
          }
          else{
              $desc_tipo_usuario = "operador";
          }
?>
		
		        <tr>	
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b> <?php echo $nombre_usuario; ?></b></font>
				</td>	
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $apellido_usuario; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $num_id; ?></b></font>
				</td>	
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $usuario; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $desc_tipo_usuario; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $desc_activo; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <a href="gestion_usuarios_mod.php?id_usu=<?php echo $id_usu_enc; ?>"> <img src="../img/ayuda.png" border=0 width=20 height=20></a></font>
				</td>

	     </tr>

	     	         
<?php
			   }
?>

                       <tr>
      <td align=center>
      <button><a href="gestion_usuarios_add.php"> <font face="Century Gothic" SIZE=2><b>Agregar nuevo usuario </b></a> </font></button>
      </td>
      </tr>
                   </table>
<br><br><hr>
                  </td>
                </tr>  

       </body>
      </html>


   
