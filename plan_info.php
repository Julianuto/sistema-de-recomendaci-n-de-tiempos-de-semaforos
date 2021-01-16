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
include "menu_usuario.php";


   $plan = $_GET["plan"];
   $lados = explode("T", $plan);

    if($lados[0]=="S"){
        $ew= "ShortTime";
    }
    else {
        $ew= "LongTime";
    }
    if($lados[1]=="S"){
        $sn= "ShortTime";
    }
    else{
        $sn= "LongTime";
    }

    if($lados[2]=="S"){
        $we= "ShortTime";
    }
    else{
        $we= "LongTime";
    }

    if($lados[3]=="S"){
        $ns= "ShortTime";
    }
    else{
        $ns= "LongTime";
    }
   ?>

     <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Información del plan actual</h1></b></font>
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
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Plan actual</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=nombre value="<?php echo $plan; ?>" readonly="readonly" required>
				</td>
	     </tr>
          <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Este Oeste</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="<?php echo $ew; ?>" readonly="readonly" required>
				</td>
	     </tr>

	     <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Sur Norte</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=tiempo value="<?php echo $sn; ?>" readonly="readonly" required>
				</td>
	     </tr>
         <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Oeste Este</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=plan value="<?php echo $we; ?>" readonly="readonly" required>
				</td>
	     </tr>
       <td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Norte Sur</b></font>
				</td>
                <td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=plan value="<?php echo $ns; ?>" readonly="readonly" required>
				</td>
	     </tr>
    



      </table>


                  </form>
<br><br>
                  </td>
                </tr>


       

       </body>
      </html>
