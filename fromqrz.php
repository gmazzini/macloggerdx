<?php

include("dati.php");
$flag=20;

$f1=file_get_contents("http://xmldata.qrz.com/xml/current/?username=$qrzusername;password=$qrzpassword;agent=gm01");
$ret=simplexml_load_string($f1);
$key=$ret->Session->Key;
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select distinct callsign from qso where flag=$flag and dxcc=0");
while($row=mysqli_fetch_assoc($res)){
  $ret=explode(" ",$row["callsign"]);
  $mycall=$ret[0];
  $f2=file_get_contents("http://xmldata.qrz.com/xml/current/?s=$key;callsign=$mycall");
  $ret=simplexml_load_string($f2);
  if(!isset($ret->Session->Error)){
    $dxcc=$ret->Callsign->dxcc; if($dxcc=="")$dxcc=0;
    $grid=mysqli_real_escape_string($ret->Callsign->grid);
    $email=mysqli_real_escape_string($ret->Callsign->email);
    $cqzone=$ret->Callsign->cqzone; if($cqzone=="")$cqzone=0;
    $ituzone=$ret->Callsign->ituzone; if($ituzone=="")$ituzone=0;
    echo "update qso set dxcc=$dxcc,grid='$grid',email='$email',cqzone=$cqzone,ituzone=$ituzone,flag=$flag where callsign='$mycall'\n";
    mysqli_query($conn,"update qso set dxcc=$dxcc,grid='$grid',email='$email',cqzone=$cqzone,ituzone=$ituzone,flag=$flag where callsign='$mycall'");
  }
}

mysqli_close($conn);

?>
