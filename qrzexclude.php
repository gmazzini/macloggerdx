<?php

include("dati.php");

$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);
$file = fopen("q6","r");
while(!feof($file)){
  $call=trim(fgets($file));
  echo "update qso set qrzmail=100 where callsign='$call' and qrzmail=0\n";
  mysqli_query($conn,"update qso set qrzmail=100 where callsign='$call' and qrzmail=0");
}
fclose($file);
mysqli_close($conn);

?>
