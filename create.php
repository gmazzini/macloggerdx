<?php


// php macloggerdx/create.php 20 2019-01-01 2021-02-14

$myband=$argv[1];
$mystart=$argv[2];
$myend=$argv[3];

include("dati.php");
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);
$ddbegin=new DateTime($mystart);
$ddend=new DateTime($myend);

for($i=$ddbegin;$i<=$ddend;$i->modify('+1 day')){
  $v=$i->format("Ymd");
  echo "$v";
  for($z=1;$z<=40;$z++){
    for($j=0;$j<24;$j++){
      $hhbegin=sprintf("%02d0000",$j);
      $hhend=sprintf("%02d5959",$j);
      $res=mysqli_query($conn,"select count(callsign),avg(rst_sent),avg(rst_rcvd) from qso where mode='FT8' and data='$v' and cqzone=$z and time>=$hhbegin and time<=$hhend and band=$myband");
      $row=mysqli_fetch_assoc($res);
      $nqso=$row["count(callsign)"];
      $asent=(int)$row["avg(rst_sent)"];
      $arcvd=(int)$row["avg(rst_rcvd)"];
      echo ",$nqso,$asent,$arcvd";
    }
  }
  echo "\n";
}
mysqli_close($conn);
?>
