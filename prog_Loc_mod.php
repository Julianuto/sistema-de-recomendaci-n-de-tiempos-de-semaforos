<?php
include "conectar.php";  // Connection has the information about the database connection.

$coordena = $_POST["coordena"]; // take the coordinate values
// which brings the latitude and longitude in the same variable

// And they are separated into two variables, Latitude and Longitude, to be able to enter them into the locations table of the database.
$id_cruce_enc= $_GET["id_cruce"];
$ubicacion_coma= strpos($coordena,","); // Place the position of the comma character in the variable.
$ubicacion_coma2 = $ubicacion_coma +1;
$largo_cad = strlen($coordena); // determines the length of the entire string.
$largo_lat = $largo_cad - $ubicacion_coma; 
$latitud = substr($coordena,0,$ubicacion_coma); // assigns the coordinate substring that corresponds to the latitude.
$longitud = substr($coordena,$ubicacion_coma2,$largo_lat); // assigns the coordinate substring that corresponds to the length.

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
