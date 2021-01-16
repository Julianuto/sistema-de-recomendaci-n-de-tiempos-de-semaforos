<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
      <title> ITCS Managment </title>
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">

    	 <tr>
         <td valign="center" align=center width=70%  bgcolor="#2E4053">
           <img src="../img/sip.png" border=0 width=150 height=150>
         </td>
         <td valign="top" align=center width=30% bgcolor="#2E4053">
          &nbsp &nbsp
           <h2> <font color=white face="Century Gothic">Login </font></h2>
            <form method="POST" action="validar.php">
              <table width="100%" align=center border=0 bgcolor="#2E4053" valign=center>
  	            <tr>
                  <td width="25%" height="20%" align="right"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold; font-family:Century Gothic"">
         		       Usuario:
                  </td>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold">
                     <input type=text value="" name="login1" required >
                  </td>
                </tr>  
  	            <tr>
                  <td width="25%" height="20%" align="right"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold; font-family:Century Gothic" >
                    Contraseña:
                  </td>
                  <td width="25%" height="20%" align="center"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold">
                     <input type=password value="" name="passwd1" required> 
                  </td>
                </tr>  
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold">
                    &nbsp;&nbsp;
                  </td>

                  <td width="25%" height="20%" align="center"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold; font-family:Century Gothic"" >
                   <input type=submit value="Get in" name="Enviar">
                   </td>

                </tr>



                <?php
                if (isset($_GET["mensaje"]))
                 {
                 $mensaje = $_GET["mensaje"];
                    if ($_GET["mensaje"]!=""){
                ?>
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="#FFCCCC" class="_espacio_celdas_p" 					
                    style="color: #FF0000; 
			             font-weight: bold">
                    Datos Incorrectos:
                  </td>
                  <td width="25%" height="20%" align="left" 				
                    bgcolor="#FFDDDD" class="_espacio_celdas_p" 					
                    style="color: #FF0000; 
			             font-weight: bold">
                    <?php 
                       if ($mensaje == 1)
                         echo "The user's password does not match.";
                       if ($mensaje == 2)
                         echo "There are no users with the login (user) entered or it is inactive.";
                       if ($mensaje == 3)
                         echo "You have not logged into the System. Please enter the data.";
                       if ($mensaje == 4)
                         echo "Your type of user does not have sufficient credentials to enter this option.";
                    ?>                         
                  </td>
                </tr>  
                <?php 
                   }
                 }
                ?>
               </table>  
             </form> 
         </td>
 	     </tr>  </table><table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
 	     <tr>
         <td valign="top" align=center width=80& colspan=2 bgcolor="#FFC300">
           <h1> <font color=white face="Century Gothic">INTELLIGENT TRAFFIC CONTROL SYSTEM</font></h1>
         </td>
       </tr> </table>       <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
 	     <tr>
         <td valign="center" align=center width=30 colspan=1 bgcolor="#2E4053">
           <img src="../img/ppal.jpg" border=0 width=600 height=350>
         </td>
         <td align=center bgcolor="#2E4053">
            <b> <font color=white face="Century Gothic">Description</font>  </b>
            <p align="justify"> <font color=white face="Century Gothic">Intelligent Traffic Control System (ITCS), focused on recommending the times of traffic lights at road junctions, complying with ITS standards to guarantee interoperability with related mobility services.</font></p>
         </td>
 	     </tr>

       </table>
     </body>
   </html>
