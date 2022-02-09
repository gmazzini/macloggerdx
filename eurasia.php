<?php
// v1 by IK4LZH, usage: cd /$HOME/Documents/MLDX_Logs; php macloggerdx/eurasia.php > /$HOME/Downloads/eurasia.cbr
$mycall="IK4LZH"; // youcall
$mydate="2022/02/05";
$mygrid="JN54QM";
$from=strtotime("$mydate 00:06:00");
$to=strtotime("$mydate 18:00:00");

echo "START-OF-LOG: 3.0\n";
echo "CONTEST: xxx\n";
echo "CALLSIGN: $mycall\n";
echo "OPERATORS: $mycall\n";
echo "NAME: xxx\n";
echo "ADDRESS: xxx\n";
echo "ADDRESS: xxx\n";

$db=new SQLite3("MacLoggerDX.sql");
$mm=array("USB"=>"PH","LSB"=>"PH","CW"=>"CW","FT8"=>"DG","MFSK"=>"DG");

$res = $db->query("SELECT call,tx_frequency,mode,qso_start,my_call,grid,rst_sent FROM qso_table_v007 where qso_start>=$from and qso_start<=$to order by qso_start");
while ($row = $res->fetchArray()) {
 if($row["my_call"]!=$mycall)continue;
 echo "QSO: ";
 $freq=(int)($row["tx_frequency"]*1000);
 if($freq>30000)$freq=(int)($freq/1000); 
 echo $freq." ";
 $mode=$mm[$row["mode"]];
 echo $mode." ";
 $date=$row["qso_start"];
 echo date("Y-m-d Hi",$date)." ";
 printf("%-13s ",$row["my_call"]);
 printf("%3s ",$row["rst_sent"]);
 printf("%6s ",$mygrid);
 printf("%-13s ",$row["call"]);
 printf("%3s ",$row["rst_received"]);
 printf("%6s",$row["grid"]);
 echo "\n";
}

echo "END-OF-LOG:\n";
$db->close();
?>
