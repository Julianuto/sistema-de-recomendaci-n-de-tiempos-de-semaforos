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
          <link rel="stylesheet" href="css/estilos_virtual.css" 			type="text/css">
           <title>Crossing management</title>
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
<table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_usuario.php";

if ((isset($_POST["enviado"])))
  {
   $id_cruce_enc = $_POST["id_cruce"];
   $nombre= $_POST["nombre"];
   $tiempo = $_POST["tiempo"];
   $ubicacion = $_POST["direccion"];
   $ew = $_POST["ew"];
   $sn = $_POST["sn"];
   $we = $_POST["we"];
   $ns = $_POST["ns"];

   $sqlu1 = "UPDATE cruce set nombre='$nombre' where id='$id_cruce_enc'";
   $resultsqlu1 = pg_query($conectar,$sqlu1);

   $sqlu5 = "UPDATE cruce set tiempo='$tiempo' where id='$id_cruce_enc'";
   $resultsqlu5 = pg_query($conectar,$sqlu5);
   
   $sqlu2 = "UPDATE cruce set direccion='$ubicacion' where id='$id_cruce_enc'";
   $resultsqlu2 = pg_query($conectar,$sqlu2);

   $sqlu7 = "UPDATE cruce set ew='$ew', sn='$sn', we='$we', ns='$ns' where id='$id_cruce_enc'";
   $resultsqlu7 = pg_query($conectar,$sqlu7);

   if (($resultsqlu1) &&  ($resultsqlu2) &&
       ($resultsqlu5))
         header('Location: tabla_sem_usuario.php?mensaje=1');
   else
         header('Location: tabla_sem_usuario.php?mensaje=2');

}

else

{
// Check the name and other data of the user to modify
   $id_cruce_enc = $_GET["id_cruce"];
   $sqlenc = "SELECT * from cruce";
   $resultenc = pg_query($conectar, $sqlenc);
   while($rowenc = pg_fetch_array($resultenc))
    {
      $id_cruce  = $rowenc[0];
      if (md5($id_cruce) == $id_cruce_enc)
        $id_cruce_enc = $id_cruce;
    }
   $sql1 = "SELECT * from cruce where id='$id_cruce_enc'";
   $result1 = pg_query($conectar, $sql1);
   $row1 = pg_fetch_array($result1);
   $nombre  = $row1[1];
   $tiempo = $row1[2];
   $plan = $row1[3];
   $ubicacion  = $row1[4];
   $ew = $row1[7];
   $sn = $row1[8];
   $we = $row1[9];
   $ns = $row1[10];

   ?>

     <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Crossing modification</h1></b></font>


		       </td>

       </tr>
   	     <tr>
                  <td colspan=2 width="25%" height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

        <form method=POST action="tabla_sem_mod.php">
        <table width=50% border=0 align=center>
			    <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Name</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=nombre value="<?php echo $nombre; ?>" required>
				</td>
	     </tr>
          <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Location</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="<?php echo $ubicacion; ?>" required>
				</td>
	     </tr>

	     <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Counting periodicity (Sec)</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="number" name=tiempo value="<?php echo $tiempo; ?>" required>
				</td>
	     </tr>
         <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Traffic lights plan</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=plan value="<?php echo $plan; ?>" readonly="readonly" required>
				</td>
	     </tr>
       <td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Long queue parameter (number of vehicles)</b></font>
				</td>
        
        <td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>East West</b></font>
				  <input size=3 type="number" name=ew value="<?php echo $ew; ?>" required>
          <br>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>South North</b></font>
				  <input size=3 type="number" name=sn value="<?php echo $sn; ?>" required>
				<br>
        
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>West East</b></font>
				  <input size=3 type="number" name=we value="<?php echo $we; ?>" required>
        <br>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>North South</b></font>
				  <input size=3 type="number" name=ns value="<?php echo $ns; ?>" required>

	     </tr>
       
	     <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Location</b></font>
				</td>
            	<td bgcolor="#EEEEEE" align=center>
            	  <font FACE="Century Gothic" SIZE=2 color="#000000"> <a href="prog_mod.php?id_cruce=<?php echo $id_cruce_enc; ?>"> <img src="../img/ayuda.png" border=0 width=20 height=20></a></font>

                  
				</td>
			     </tr>



      </table>

         <input type="hidden" value="S" name="enviado">
         <input type="hidden" value="<?php echo $id_cruce_enc; ?>" name="id_cruce">
         <table width=50% align=center border=0>
           <tr>
             <td width=50%></td>
             <td align=center><input type=submit color= blue value="Modify" name="Modificar">
                  </form>
             </td>
             <td align=left>
                  <form method=POST action="tabla_sem_usuario.php">
                  <input type=submit color= blue value="Return" name="Volver">
                  </form>
             </td>
           </tr>
<?php
    if (isset($_GET["mensaje"]))
    {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){
            ?>
		    <table>
  		    <tr>
            <td> </td>
            <td height="20%" align="left">
            <table width=60% border=1>
            <tr>
            <?php
            if ($mensaje == 1)
                echo "<td bgcolor=#94DA60 class=_espacio_celdas_pstyle=color: #000000; font-weight: bold >Location created successfully.";
            if ($mensaje == 2)
                echo "<td bgcolor=#DC756C class=_espacio_celdas_pstyle=color: #000000; font-weight: bold >Disadvantage when creating the location.";
            echo "</td></tr></table>
            </td>
    		</tr>
            <table>";
        }
    }
?>
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
