<?php
// cat out30 | php macloggerdx/graph.php | convert pgm:- z30.png

ini_set("memory_limit","512M");

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

// $maxqso=max($myqso);

$minkey=min(array_keys($myqso));
$maxkey=max(array_keys($myqso));
$d1b=new DateTime(substr($minkey,0,8));
$d1e=new DateTime(substr($maxkey,0,8));
$mydiff=$d1e->diff($d1b);
$totdays=$mydiff->format("%a");
$mymm=(($mydiff->y)*12)+($mydiff->m);

$aux=$totdays+$mymm;
echo "1000 $aux\n";
echo "$mytop\n";

$ov="";
for($i=$d1b;$i<=$d1e;$i->modify('+1 day')){
  $v=$i->format("Ymd");
  if(substr($v,0,6)!=$ov){
    $ov=substr($v,0,6);
    for($j=0;$j<1000;$j++)echo "$mytop ";
    echo "\n";
  }
  for($cq=1;$cq<=40;$cq++){
    for($hh=0;$hh<24;$hh++){
      echo $myqso["$v.$cq.$hh"]." ";
    }
    echo "$mytop ";
  }
  echo "\n";
}
fclose($fp);
?>
