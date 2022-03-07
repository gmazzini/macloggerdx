<?php

include("dati.php");
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select distinct callsign from qso where qrzflag=1 limit 100");
while($row=mysqli_fetch_assoc($res)){
  $ret=explode(" ",$row["callsign"]);
  $call=$ret[0];
  echo $call."\n";
}

mysqli_close($conn);

?>
