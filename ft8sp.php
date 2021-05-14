<?php
// v1 by IK4LZH 20210514
// usage: cd /$HOME/Documents/MLDX_Logs; php macloggerdx/ft8sp.php > /$HOME/Downloads/ft8sp.cbr
$mycall="IK4LZH"; // youcall
$mycontest="cqm21";

$db=new SQLite3("MacLoggerDX.sql");
$mm=array("USB"=>"PH","LSB"=>"PH","CW"=>"CW","FT8"=>"DG","MFSK"=>"DG");

$res = $db->query("SELECT call,tx_frequency,mode,qso_start,my_call,rst_sent,rst_received FROM qso_table_v007 where contest_id='$mycontest' order by qso_start");
while ($row = $res->fetchArray()) {
 if($row["my_call"]!=$mycall)continue;
 $aux=$row["call"]; echo "<call:".strlen($aux).">".$aux;
 $aux=date("Ymd",$row["qso_start"]); echo "<qso_date:".strlen($aux).">".$aux;
 $aux=date("Hi",$row["qso_start"]); echo "<time_on:".strlen($aux).">".$aux;
 $aux=$row["mode"]; echo "<mode:".strlen($aux).">".$aux;
 echo "<eor>\n";

 
 //call:5>KG0KG<band:3>80M<mode:3>SSB<qso_date:8>20200311<time_on:4>1904<eor>

 
 
 
 
}

$db->close();
?>
