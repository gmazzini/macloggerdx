<?php
// v1 by IK4LZH 20210514
// usage: cd /$HOME/Documents/MLDX_Logs; php macloggerdx/ft8sp.php > /$HOME/Downloads/ft8sp.cbr
$mycall="IK4LZH"; // youcall
$myfrom="20210505";
$fromdate=mktime(0,0,0,(int)substr($myfrom,4,2),(int)substr($myfrom,6,2),(int)substr($myfrom,0,4));

$db=new SQLite3("MacLoggerDX.sql");

$res = $db->query("SELECT call,tx_frequency,mode,qso_start,my_call,rst_sent,rst_received FROM qso_table_v007 where qso_start>=$fromdate order by qso_start");
while ($row = $res->fetchArray()) {
 if($row["my_call"]!=$mycall)continue;
 $aux=$row["call"]; echo "<CALL:".strlen($aux).">".$aux;
 $aux=date("Ymd",$row["qso_start"]); echo "<QSO_START:".strlen($aux).">".$aux;
 $aux=date("Hi",$row["qso_start"]); echo "<TIME_ON:".strlen($aux).">".$aux;
 $aux=$row["mode"]; echo "<MODE:".strlen($aux).">".$aux;
 $aux=floor($row["tx_frequency"]); echo "<BAND:".strlen($aux).">".$aux;
 $aux=$row["tx_frequency"]; echo "<FREQ:".strlen($aux).">".$aux;
 $aux=$row["rst_sent"]; echo "<RST_SENT:".strlen($aux).">".$aux;
 $aux=$row["rst_received"]; echo "<RST_RCVD:".strlen($aux).">".$aux;
 
 echo "<eor>\n";

 //call:5>KG0KG<band:3>80M<mode:3>SSB<qso_date:8>20200311<time_on:4>1904<eor>

 
 
 
 
}

$db->close();
?>
