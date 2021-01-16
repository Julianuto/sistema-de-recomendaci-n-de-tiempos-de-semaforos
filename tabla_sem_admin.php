<?php

// ADMINISTRATOR MENU PROGRAM
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
include "menu_admin.php";
?>
         <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Table of traffic lights</h1></b></font>
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
                    style=color: #000000; font-weight: bold >crossing updated successfully.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >crossing was not updated correctly.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >crossing created correctly.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >crossing was not created. An issue occurred";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >crossing was not created. There is already a cross with the same id.";

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
              &nbsp;&nbsp;&nbsp;</b></font>
              </td>
              <td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
                Long queue parameter (number of vehicles) </b></font>
              </td>
              
            </tr>
           </table>
      <table width=80% border=0 align=center>
			<tr>
        <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  Name</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
        Counting periodicity (Sec)</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 plan</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  Location</b></font>
				</td>
   	    <td bgcolor="#F4B120" align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 To locate</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  East West</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  South North</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>     <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  West East</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 North South</b></font>
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
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $plan; ?>&nbsp;&nbsp;&nbsp;</b></font><a href="plan_info_admin.php?plan=<?php echo $plan; ?>"><img src="../img/lupa.png" border=0 width=20 height=20></a>
				</td>
				<td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $ubicacion; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <a href="prog_admin.php?id_cruce=<?php echo $id_cruce; ?>"> <img src="../img/ver.png" border=0 width=20 height=20></a></font>
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

