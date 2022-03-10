<?php

include("dati.php");
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select callsign,email from qso where qrzmail=0 and length(email)>5 group by callsign");
$cc=0;
while($row=mysqli_fetch_assoc($res)){
  $ret=explode(" ",$row["callsign"]);
  $vv[$cc]["call"]=$ret[0];
  $vv[$cc]["email"]=$row["email"];
  $cc++;
}

shuffle($vv);

for($a=0;$a<$cc;$a++){
  echo $a.",".$vv[$a]["call"].",".$vv[$a]["email"]."\n";
}

mysqli_close($conn);

?>
