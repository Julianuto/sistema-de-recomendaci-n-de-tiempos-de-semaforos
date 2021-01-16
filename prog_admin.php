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
                     <h1><font color=#FFFFFF face="Century Gothic">SISTEMA DE CONTROL DE TRÁFICO INTELIGENTE</font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right>
              <font FACE="arial" SIZE=2 color="#FFFFFF"> <b><u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#FFFFFF"> <b><u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#E32B23"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>

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
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Ubicacion de parqueadero</h1></b></font>


		       </td>

	    </tr>
	  </table>
  <?php
$id_cruce_enc= $_GET["id_cruce"];
$sqlubi = "SELECT * from cruce where id='$id_cruce_enc'"; //CONSULTA LA ULTIMA UBICACION AGREGADA A LA TABLA UBICACIONES
$resultubi = pg_query($conectar,$sqlubi);
$rowubi = pg_fetch_array($resultubi);
$latitud = $rowubi[5];
$longitud = $rowubi[6];

?>
    <div id="map"></div>


    <script>


var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalizaci�n

//Funcion principal
initMap = function ()
{

    //usamos la API para geolocalizar el usuario

// Cuando no funcione geolocalizaci�n, se comentan las siguientes lineas y se asigna coordenadas fijas
// Si funciona la geolocalizaci�n, se pueden descomentar las l�neas y utilizarla, sin asignar coordenadas fijas
//        navigator.geolocation.getCurrentPosition(
//          function (position){
//            coords =  {
//              lng: position.coords.longitude,
//              lat: position.coords.latitude
//            };
//            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
          var latit= <?php echo $latitud ?>;
          var longi= <?php echo $longitud ?>;
          var uluru = {lat: latit, lng: longi};
          coords= uluru;
          setMapa(coords);
//        },function(error){console.log(error);});

}



function setMapa (coords)
{
      //Se crea una nueva instancia del objeto mapa
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 15,
        center:new google.maps.LatLng(coords.lat,coords.lng),

      });

      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalizaci�n
      marker = new google.maps.Marker({
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),

      });
      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica
      //cuando el usuario a soltado el marcador
      marker.addListener('click', toggleBounce);

      marker.addListener( 'dragend', function (event)
      {
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
      });
}

//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

// Carga de la libreria de google maps

    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYfauZqaXuEdb2Kfog5IuKDh-pB5U6BVM&callback=initMap"></script> <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->


  </body>
</html>
