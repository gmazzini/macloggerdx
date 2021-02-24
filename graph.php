<?php
// cat out30 | php macloggerdx/graph.php 1 | convert pgm:- z30.png
// 1=qso 2=sent 3=rcvd

ini_set("memory_limit","512M");
include("myfont.php");
$type=$argv[1];

echo "P2\n";
echo "# by GM\n";
$fp=fopen("php://stdin","r");
while($line=fgets($fp)){
  $qq=str_getcsv($line);
  for($cq=1;$cq<=40;$cq++){
    for($hh=0;$hh<24;$hh++){
      $j=$hh+($cq-1)*24;
      $aux=$qq[$j*3+1];
      if($aux==0)$mydata["$qq[0].$cq.$hh"]=-1000;
      else $mydata["$qq[0].$cq.$hh"]=$qq[$j*3+$type];
    }
  }
}

$minkey=min(array_keys($mydata));
$maxkey=max(array_keys($mydata));
$d1b=new DateTime(substr($minkey,0,8));
$d1e=new DateTime(substr($maxkey,0,8));
$mydiff=$d1e->diff($d1b);
$totdays=$mydiff->format("%a");
$mymm=(($mydiff->y)*12)+($mydiff->m);

$aux=$totdays+$mymm+10;
$ttxx=1030;
switch($type){
  case 1: $mytop=5; $mybase=0; break;
  case 2: $mytop=35; $mybase=25; break;
  case 3: $mytop=35; $mybase=25; break;
}

echo "$ttxx $aux\n";
echo "$mytop\n";

for($cq=1;$cq<=40;$cq++){
  $myt=sprintf("%02d",$cq);
  $oo[$cq]=mys([$myt],30,9);
}
for($y=10;$y<19;$y++){
  for($x=0;$x<29;$x++)echo "0 ";
  echo "$mytop ";
  for($cq=1;$cq<=40;$cq++){
    for($i=0;$i<24;$i++){
      if($oo[$cq][$y][$i]=="1")echo "$mytop ";
      else echo "0 ";
    }
    echo "$mytop ";
  }
  echo "\n";
}

$ov="";
for($i=$d1b;$i<=$d1e;$i->modify('+1 day')){
  $v=$i->format("Ymd");
  if(substr($v,0,6)!=$ov){
    $ov=substr($v,0,6);
    $nnr=0;
    $oox=mys([$mym[(int)substr($v,4,2)-1],substr($v,0,4)],29,31);
    for($j=0;$j<$ttxx;$j++)echo "$mytop ";
    echo "\n";
  }

  for($x=0;$x<29;$x++){
    if($oox[$nnr+10][$x]=="1")echo "$mytop ";
    else echo "0 ";
  }
  echo "$mytop ";
  $nnr++;

  for($cq=1;$cq<=40;$cq++){
    for($hh=0;$hh<24;$hh++){
      $aux=$mydata["$v.$cq.$hh"];
      if($aux==-1000){
        echo "0 "; 
      }
      else if($aux>100){
        echo ((int)$mytop/2)." ";
      }
      else {
        $aux=$aux+$mybase;
        echo min($mytop,$aux)." ";
      }
    }
    echo "$mytop ";
  }
  echo "\n";
}
fclose($fp);
?>
