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
    <meta charset="utf-8">
    <title>Localizar</title>
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
  <body >
  <table width="100%" align=center cellpadding=5 border=0 bgcolor="#2E4053">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="../img/sip.png" border=0 width=90 height=90>
             	    </td>
                 <td valign="bottom" align=center width=60%>
                     <h1><font color=#FFFFFF face="Century Gothic">INTELLIGENT TRAFFIC CONTROL SYSTEM</font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right>
              <font FACE="arial" SIZE=2 color="#FFFFFF"> <b><u><?php  echo "Username</u>:   ".$_SESSION["nombre"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#FFFFFF"> <b><u><?php  echo "User type</u>:   ".$desc_tipo_usuario;?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#E32B23"> <b><u> <a href="cerrar_sesion.php"> Logout </a></u></b></font>

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
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Parking location</h1></b></font>


		       </td>

	    </tr>
	  </table>
  <?php
$id_cruce_enc= $_GET["id_cruce"];
$sqlubi = "SELECT * from cruce where id='$id_cruce_enc'"; // SEE THE LAST LOCATION ADDED TO THE LOCATIONS TABLE
$resultubi = pg_query($conectar,$sqlubi);
$rowubi = pg_fetch_array($resultubi);
$latitud = $rowubi[5];
$longitud = $rowubi[6];

?>
    <div id="map"></div>


    <script>


var marker;          // marker variable
var coords = {};    // coordinates obtained with geolocation

//Funcion principal
initMap = function ()
{

    // we use the API to geolocate the user

          var latit= <?php echo $latitud ?>;
          var longi= <?php echo $longitud ?>;
          var uluru = {lat: latit, lng: longi};
          coords= uluru;
          setMapa(coords);
//        },function(error){console.log(error);});

}



function setMapa (coords)
{
      // A new instance of the map object is created
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
      // we add an event to the marker together with the callback function as well as the dragend event that indicates
      // when the user has dropped the marker
      marker.addListener('click', toggleBounce);

      marker.addListener( 'dragend', function (event)
      {
        // we write the coordinates of the current position of the marker inside the input #coords
        document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
      });
}

// callback when clicking on the marker what it does is remove and put the BOUNCE animation
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

// Loading the google maps library

    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYfauZqaXuEdb2Kfog5IuKDh-pB5U6BVM&callback=initMap"></script>


  </body>
</html>
