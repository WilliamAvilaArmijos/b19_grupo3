<?php 
$conn_string = "host=localhost port=5432 dbname=Firmadb user=postgres password=root";
$dbconn = pg_connect($conn_string);  
if ($dbconn == false ) {
   echo "Ocurrió un error en la coneccion";
   exit;
 }
?>