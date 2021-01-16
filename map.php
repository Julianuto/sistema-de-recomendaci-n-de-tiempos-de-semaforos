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
         <style>
          html, body {
            height: 100%;
            margin: 0;
            padding: 0;
          }
          #map {
            width: 100%;
            height: 80%;
          }
          #coords{width: 500px;}
        </style>
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
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Locate traffic lights crossing</h1></b></font>


		       </td>

	    </tr>
	  </table>
<?php
  $sqlubi = "SELECT * from cruce where id=1";
  $resultubi = pg_query($conectar, $sqlubi);
  $rowubi = pg_fetch_array($resultubi);
  $latitud = $rowubi[5];
  $longitud = $rowubi[6];
?>
  
  <div id="map"></div>
<script>


var marker;          //marker variable
var coords = {};    //coordinates obtained with geolocation

//Main Function 
initMap = function () 
{

    //we use the API to geolocate the user
//            setMapa(coords);  //we pass the coordinates to the method to create the map
          var latit= <?php echo $latitud ?>;
          var longi= <?php echo $longitud ?>;
          var uluru = {lat: latit, lng: longi};
          coords= uluru;
          var latit2= 2.447453627153113;
          var longi2= -76.59787093017674;
          var uluru2 = {lat: latit2, lng: longi2};
          coords2= uluru2;
          setMapa(coords,coords2); 
//        },function(error){console.log(error);});
    
}



function setMapa (coords,coords2)
{   
      //A new instance of the map object is created
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 15,
        center:new google.maps.LatLng(coords.lat,coords.lng),

      });

      // We create the marker on the map with its properties
       // for our objective we have to set the draggable attribute to true
       // position we will put the same coordinates that we obtained in the geolocation
      marker = new google.maps.Marker({
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),

      });
      marker2 = new google.maps.Marker({
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords2.lat,coords2.lng),

      });
      // we add an event to the marker together with the callback function as well as the dragend event that indicates
       // when the user has dropped the marker
      marker.addListener('click', redirigir);
      marker2.addListener('click', redirigir2);
}

// callback when clicking on the marker what it does is remove and put the BOUNCE animation
function redirigir() {
    location.href ="tabla_sem_mod.php?id_cruce=c4ca4238a0b923820dcc509a6f75849b";
}
function redirigir2() {
    location.href ="tabla_sem_mod.php?id_cruce=c81e728d9d4c2f636f067f89cc14862c";
}
// Loading the google maps library

    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYfauZqaXuEdb2Kfog5IuKDh-pB5U6BVM&callback=initMap"></script> 
  

  </body>
</html>
