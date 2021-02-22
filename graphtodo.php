<?php

echo "P2\n";
echo "# by GM\n";
include("dati.php");
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$ddbegin=new DateTime("2019-01-01");
$ddend=new DateTime("2021-02-01");

$totdays=$ddend->diff($ddbegin)->format("%a");

echo "1000 $totdays\n";
echo "20\n";

for($i=$ddbegin;$i<=$ddend;$i->modify('+1 day')){
  $v=$i->format("Ymd");

  for($z=1;$z<=40;$z++){
 
    for($j=0;$j<24;$j++){
      $hhbegin=sprintf("%02d0000",$j);
      $hhend=sprintf("%02d5959",$j);
      $res=mysqli_query($conn,"select count(callsign) from qso where mode='FT8' and data='$v' and cqzone=$z and time>=$hhbegin and time<=$hhend and band=20");
      $row=mysqli_fetch_assoc($res);
      $nqso=$row["count(callsign)"];
      echo "$nqso ";
    }
    echo "20 ";
  }
  echo "\n";
}

mysqli_close($conn);


?>
