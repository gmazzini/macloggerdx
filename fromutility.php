<?php

include("dati.php");
include("ik4lzh/utility.php");

$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select distinct callsign from qso where dxcc=0");
while($row=mysqli_fetch_assoc($res)){
  $call=$row["callsign"];
  $mys=findcall($call)
  $dxcc=(int)$mys["dxcc"];
  $cqzone=(int)$mys["cqzone"];
  $ituzone=(int)$mys["ituzone"];

//  mysqli_query($conn,"update qso set dxcc=$dxcc,cqzone=$cqzone,ituzone=$ituzone where callsign='$mycall'");
  echo "update qso set dxcc=$dxcc,cqzone=$cqzone,ituzone=$ituzone where callsign='$mycall'\n";

}

mysqli_close($conn);
?>
