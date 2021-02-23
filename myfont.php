<?php

// https://fontstruct.com/fontstructions/show/847768/5x7_dot_matrix

$myf["A"]=["00100","01010","10001","10001","11111","10001","10001"];
$myf["B"]=["11110","01001","01001","01110","01001","01001","11110"];
$myf["C"]=["01110","10001","10000","10000","10000","10001","01110"];
$myf["D"]=["11110","01001","01001","01001","01001","01001","11110"];
$myf["E"]=["11111","10000","10000","11110","10000","10000","11111"];
$myf["F"]=["11111","10000","10000","11110","10000","10000","10000"];
$myf["G"]=["01110","10001","10000","10011","10001","10001","01111"];
$myf["H"]=["10001","10000","10000","11111","10001","10001","10001"];
$myf["I"]=["01110","00100","00100","00100","00100","00100","01110"];
$myf["J"]=["00111","00010","00010","00010","00010","10010","01100"];
$myf["K"]=["10001","10010","10100","11000","10100","10010","10001"];
$myf["L"]=["10000","10000","10000","10000","10000","10000","11111"];
$myf["M"]=["10001","11011","10101","10101","10001","10001","10001"];
$myf["N"]=["10001","10001","11001","10101","10011","10001","10001"];
$myf["O"]=["01110","10001","10001","10001","10001","10001","01110"];
$myf["P"]=["11110","10001","10001","11110","10000","10000","10000"];
$myf["Q"]=["01110","10001","10001","10001","10101","10010","01101"];
$myf["R"]=["11110","10001","10001","11110","10100","10010","10001"];
$myf["S"]=["01110","10001","10000","01110","00001","10001","01110"];
$myf["T"]=["11111","00100","00100","00100","00100","00100","00100"];
$myf["U"]=["10001","10001","10001","10001","10001","10001","01110"];
$myf["V"]=["10001","10001","10001","10001","10001","01010","00100"];
$myf["W"]=["10001","10001","10001","10101","10101","10101","01010"];
$myf["X"]=["10001","10001","01010","00100","01010","10001","10001"];
$myf["Y"]=["10001","10001","10001","01010","00100","00100","00100"];
$myf["Z"]=["11111","00001","00010","00100","01000","10000","11111"];
$myf["0"]=["01110","10001","10011","10101","11001","10001","01110"];
$myf["1"]=["00100","01100","00100","00100","00100","00100","01110"];
$myf["2"]=["01110","10001","00001","00110","01000","10000","11111"];
$myf["3"]=["01110","10001","00001","00110","00001","10001","01110"];
$myf["4"]=["00010","00110","01010","10010","11111","00010","00010"];
$myf["5"]=["11111","10000","11110","00001","00001","10001","01110"];
$myf["6"]=["00110","01000","10000","11110","10001","10001","01110"];
$myf["7"]=["11111","00001","00010","00100","01000","01000","01000"];
$myf["8"]=["01110","10001","10001","01110","10001","10001","01110"];
$myf["9"]=["01110","10001","10001","01111","00001","00010","01100"];


function mys($qq,$hlen,$vlen){
  global $myf;
  $mqq=strtoupper($qq);
  $lqq=strlen($qq);
  $sqq=$hlen-$lqq*6;
  if($sqq<0)return NULL;
  $rr[0]=str_pad("",$hlen,"0");
  for($i=0;$i<7;$i++){
    $rr[1+$i]=str_pad("",$sqq/2,"0");
    for($j=0;$j<$lqq;$j++){
      $rr[1+$i].=$myf[$qq[$j]][$i]."0";
    }
    $rr[1+$i].=str_pad("",$sqq-$sqq/2,"0");
  }
  $rr[8]=str_pad("",$hlen,"0");
  return $rr;
}

print_r(mys("01",24,10));

?>
