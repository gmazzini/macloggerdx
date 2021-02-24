<?php
// cat out30 | php macloggerdx/graph.php | convert pgm:- z30.png

ini_set("memory_limit","512M");
include("myfont.php");

echo "P2\n";
echo "# by GM\n";
$mytop=5;

$fp=fopen("php://stdin","r");
while($line=fgets($fp)){
  $qq=str_getcsv($line);
  for($cq=1;$cq<=40;$cq++){
    for($hh=0;$hh<24;$hh++){
      $j=$hh+($cq-1)*24;
      $myqso["$qq[0].$cq.$hh"]=$qq[$j*3+1];
      $mysent["$qq[0].$cq.$hh"]=$qq[$j*3+2];
      $myrcvd["$qq[0].$cq.$hh"]=$qq[$j*3+3];
    }
  }
}

$minkey=min(array_keys($myqso));
$maxkey=max(array_keys($myqso));
$d1b=new DateTime(substr($minkey,0,8));
$d1e=new DateTime(substr($maxkey,0,8));
$mydiff=$d1e->diff($d1b);
$totdays=$mydiff->format("%a");
$mymm=(($mydiff->y)*12)+($mydiff->m);

$aux=$totdays+$mymm+10;
$ttxx=1030;
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
    for($hh=0;$hh<24;$hh++)echo min($mytop,$myqso["$v.$cq.$hh"])." ";
    echo "$mytop ";
  }
  echo "\n";
}
fclose($fp);
?>
