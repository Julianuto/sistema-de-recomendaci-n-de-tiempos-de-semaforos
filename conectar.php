<?php
$conectar = pg_connect("host=ec2-52-5-176-53.compute-1.amazonaws.com port=5432 user=vsemigwrofvgsy password=dec78e50cb74ebc76535f8d151c84df463eeeaed42063d5eb51a0b2b36f81643 dbname=de220cmq22267r");
if (!$conectar) {
  echo "Ha ocurrido un error.\n";
}
  
?>
 
