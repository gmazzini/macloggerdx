<?php

include("dati.php");
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select callsign from qso where qrzmail=0 group by callsign");
while($row=mysqli_fetch_assoc($res)){
  $ret=explode(" ",$row["callsign"]);
  $call=$ret[0];
  $res1=mysqli_query($conn,"select count(*) from qso where qrzmail>0 and callsign='$call'");
  $row1=mysqli_fetch_assoc($res1);
  $num=$row1["count(*)"];
  if($num>0)echo $call."\n";
}

mysqli_close($conn);

?>
