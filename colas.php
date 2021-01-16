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
           <title>  ITCS Management </title>
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
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Traffic information (queues)</h1></b></font>
	       </td>

	    </tr>
	  </table>
	  
    <table width="100%" align=center cellpadding=0 border=0 bgcolor="#FFFFFF">
      <tr>
       <td align=left width=50%>
        <form action="gestion_usuarios.php" method="POST">

      </tr>

         <tr>
                  <td colspan=2 height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

                    <table width=60% border=0 align=center>
			 <tr>
       <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  Crossing</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  East West</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 South North</b></font>
				</td>
        <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 West East</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  North South</b></font>
				</td>
                <td bgcolor="#F4B120" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  Date</b></font>
				</td>
                </tr>

<?php
        $sql1 = "select * from colas_reales";
         $result1 = pg_query($conectar, $sql1);
         while($row1 = pg_fetch_array($result1))
         {
            $id_cola = $row1[0];
            $id_cruce = $row1[1];
            $ew  = $row1[2];
            $sn  = $row1[3];
            $we = $row1[4];
            $ns = $row1[5];
            $fecha = $row1[6];
            $sql2 = "select * from cruce where id='$id_cruce'";
            $result2 = pg_query($conectar, $sql2);
            $row2=$row1 = pg_fetch_array($result2);
            $nombre = $row2[1];

?>

        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b> <?php echo $nombre; ?></b></font>
				</td>
        <td bgcolor="#EEEEEE" align=center>
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b> <?php echo $ew; ?></b></font>
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
        <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $fecha; ?></b></font>
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

