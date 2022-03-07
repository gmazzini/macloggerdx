<?php
// php macloggerdx/qrzmail.php > q4

include("dati.php");
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select callsign,email from qso where qrzmail=0 and length(email)>5 group by callsign limit 1000");
while($row=mysqli_fetch_assoc($res)){
  $ret=explode(" ",$row["callsign"]);
  $call=$ret[0];
  $email=$row["email"];
  echo $call.",".$email."\n";
  mysqli_query($conn,"update qso set qrzmail=2 where callsign='$call'");

}

mysqli_close($conn);

?>

