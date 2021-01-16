<?php
include "conectar.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.

$coordena = $_POST["coordena"]; // toma los valores de coordenada
// que trae la latitud y longitud en la misma variable

// Y se separan en dos variables, Latitud y longitud, para poder ingresarlas a la tabla ubicaciones de la base de datos.
$id_cruce_enc= $_GET["id_cruce"];
$ubicacion_coma= strpos($coordena,","); // Ubica la posici�n del caracter coma en la variable.
$ubicacion_coma2 = $ubicacion_coma +1;
$largo_cad = strlen($coordena); // determina el largo de toda la cadena.
$largo_lat = $largo_cad - $ubicacion_coma; 
$latitud = substr($coordena,0,$ubicacion_coma); // asigna la subcadena de coordenada que le corresponde a la latitud.
$longitud = substr($coordena,$ubicacion_coma2,$largo_lat); // asigna la subcadena de coordenada que le corresponde a la longitud.

echo "lat...".$latitud;
echo "long...".$longitud;

$sql1 = "UPDATE cruce SET latitud = '$latitud', longitud = '$longitud' WHERE ID= '$id_cruce_enc'"; //

$result1 = pg_query($conectar, $sql1);
if ($id_cruce_enc==1){
  if ($result1)
    {
              header('Location:tabla_sem_mod.php?mensaje=1&id_cruce=1');
              
    }
  else
    {
              header('tabla_sem_mod.php?mensaje=2&id_cruce=1');
    }
}
if ($id_cruce_enc==2){
  if ($result1)
    {
              header('Location:tabla_sem_mod.php?mensaje=1&id_cruce=2');

    }
  else
    {
              header('tabla_sem_mod.php?mensaje=2&id_cruce=2');
    }
}
?>
