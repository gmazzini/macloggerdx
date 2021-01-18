<?php
// v0... just start to write by IK4LZH, usage: cd /$HOME/Documents/MLDX_Logs; php hadx.php
$mycontest="hadx 2020";
$mycall="IK4LZH";

$db=new SQLite3("MacLoggerDX.sql");
$mm=array("USB"=>"PH","LSB"=>"PH","CW"=>"CW","FT8"=>"DG","MFSK"=>"DG");

$res = $db->query("SELECT call,band_tx,dxcc_id,mode FROM qso_table_v007 where contest_id='$mycontest' limit 20");
while ($row = $res->fetchArray()) {
  $myid=$row["band_tx"]."-".$mm[$row["mode"]]."-".$row["call"];
  echo $myid."\n";
  if(!isset($qso[$myid]))$qso[$myid]=1;
  else $qso[$myid]++;
 
  $myid=$row["band_tx"]."-".$row["dxcc_id"];
  echo $myid."\n";
  if(!isset($mult[$myid]))$mult[$myid]=1;
  else $mult[$myid]++;

}

echo array_sum($qso)." qso\n";
echo array_sum($mult)." mult\n";


?>
