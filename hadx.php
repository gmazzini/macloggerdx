<?php
// v0... just start to write by IK4LZH, usage: cd /$HOME/Documents/MLDX_Logs; php hadx.php
$mycontest="hadx 2020";
$mycall="IK4LZH";

$db=new SQLite3("MacLoggerDX.sql");
$mm=array("USB"=>"PH","LSB"=>"PH","CW"=>"CW","FT8"=>"DG","MFSK"=>"DG");

$res = $db->query("SELECT call,band_tx,dxcc_id,mode FROM qso_table_v007 where contest_id='$mycontest' limit 1");
while ($row = $res->fetchArray()) {

 printf_r($row);
 echo "\n";
}


?>
