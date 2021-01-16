<?php
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
           <title>  Administracion SCTI </title>
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
include "menu_usuario.php";
?>
         <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Tabla de cruces</h1></b></font>
	       </td>

	    </tr>
	  </table>
	  
    <table width="100%" align=center cellpadding=0 border=0 bgcolor="#FFFFFF">
      <tr>
       <td align=left width=50%>
        <form action="gestion_usuarios.php" method="POST">

      </tr>
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>

  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Cruce actualizado correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >El cruce no fue actualizado correctamente.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >El cruce creado correctamente.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >El cruce no fue creado. Se present� un inconveniente";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >El cruce no fue creado. Ya existe un cruce con la misma id.";

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

              <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;</b></font>
              </td>
              <td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
                Parametro cola larga (numero vehiculos) </b></font>
              </td>
              <td bgcolor="#F4B120" align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              </b></font>
              </td>
            </tr>
           </table>

      <table width=80% border=0 align=center>
      <tr>
        <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  Nombre</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
        Periodicidad conteo (Seg)</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 plan</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  Ubicacion</b></font>
				</td>
   	    <td bgcolor="#F4B120" align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 Localizar</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  este oeste</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  sur norte</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  oeste este</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 norte sur</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 Modificar</b></font>
				</td>
			</tr>
           
<?php
         $sql1 = "SELECT * from cruce order by nombre";
         $result1 = pg_query($conectar, $sql1);
         while($row1 = pg_fetch_array($result1))
         {
			    $id_cruce  = $row1[0];
			    $id_cruce_enc = md5($id_cruce);
			    $nombre  = $row1[1];
          $tiempo  = $row1[2];
          $plan = $row1[3];
	     	  $ubicacion = $row1[4];
     	    $latitud  = $row1[5];
          $longitud = $row1[6];
          $ew = $row1[7];
          $sn = $row1[8];
          $we = $row1[9];
          $ns = $row1[10];
?>

        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b> <?php echo $nombre; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $tiempo; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $plan; ?>&nbsp;&nbsp;&nbsp;</b></font><a href="plan_info.php?plan=<?php echo $plan; ?>"><img src="../img/lupa.png" border=0 width=20 height=20></a>
				</td>
				<td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $ubicacion; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <a href="prog_usuario.php?id_cruce=<?php echo $id_cruce; ?>"> <img src="../img/ver.png" border=0 width=20 height=20></a></font>
        </td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $ew; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $sn; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $we; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $ns; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <a href="tabla_sem_mod.php?id_cruce=<?php echo $id_cruce_enc; ?>"> <img src="../img/ayuda.png" border=0 width=20 height=20></a></font>
        </td>
        </tr>
<?php
			   }
?>
           </table>
<br><br><br><br>
                  </td>
                </tr>
        </table>

</body>
</html>

