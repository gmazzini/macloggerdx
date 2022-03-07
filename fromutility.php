<?php
include("dati.php");
include("ik4lzh/utility.php");

$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select distinct callsign from qso where dxcc=0 or cqzone=0 or ituzone=0");
while($row=mysqli_fetch_assoc($res)){
  $ret=explode(" ",$row["callsign"]);
  $call=$ret[0];
  $mys=findcall($call);
  if($mys["base"]=="K")continue;
  $dxcc=(int)$mys["dxcc"];
  $cqzone=(int)$mys["cqzone"];
  $ituzone=(int)$mys["ituzone"];
  echo "update qso set dxcc=$dxcc,cqzone=$cqzone,ituzone=$ituzone where callsign='$call'\n";
  mysqli_query($conn,"update qso set dxcc=$dxcc,cqzone=$cqzone,ituzone=$ituzone where callsign='$call'");

}

mysqli_close($conn);
?>
