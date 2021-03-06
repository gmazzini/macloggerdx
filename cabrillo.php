<?php
// v2 by IK4LZH, usage: cd /$HOME/Documents/MLDX_Logs; php macloggerdx/cabrillo.php > /$HOME/Downloads/hadx.cbr
$mycontest="UBA2021"; // contest id label
$mycall="IK4LZH"; // youcall

echo "START-OF-LOG: 3.0\n";
echo "CONTEST: xxx\n";
echo "CALLSIGN: $mycall\n";
echo "CLAIMED-SCORE: xxx\n";
echo "OPERATORS: $mycall\n";
echo "NAME: xxx\n";
echo "ADDRESS: xxx\n";
echo "ADDRESS: xxx\n";

$db=new SQLite3("MacLoggerDX.sql");
$mm=array("USB"=>"PH","LSB"=>"PH","CW"=>"CW","FT8"=>"DG","MFSK"=>"DG");

$res = $db->query("SELECT call,tx_frequency,mode,qso_start,my_call,rst_sent,rst_received,srx,srx_numeric,stx,stx_numeric FROM qso_table_v007 where contest_id='$mycontest' order by qso_start");
while ($row = $res->fetchArray()) {
 if($row["my_call"]!=$mycall)continue;
 echo "QSO: "; // label 4c+s
 $freq=(int)($row["tx_frequency"]*1000);
 if($freq>30000)$freq=(int)($freq/1000); 
 echo $freq." "; // frequency 5c+s
 $mode=$mm[$row["mode"]];
 echo $mode." "; // mode 2c+s
 $date=$row["qso_start"];
 echo date("Y-m-d Hi",$date)." "; // date time 15c+s
 printf("%-13s ",$row["my_call"]); // 13c+s
 printf("%3s ",$row["rst_sent"]); // rst_sent 3c+s
 $myaux=(int)$row["stx_numeric"];
 if($myaux>0)printf("%03d %2s ",$myaux,$row["stx"]); // stx_sent 6c+s
 else printf("%6s ",$row["stx"]);
 printf("%-13s ",$row["call"]); // 13c+s
 printf("%3s ",$row["rst_received"]); // rst_sent 3c+s
 $myaux=(int)$row["srx_numeric"];
 if($myaux>0)printf("%03d %2s ",$myaux,$row["srx"]); // stx_sent 6c+s
 else printf("%6s ",$row["srx"]);
 echo "\n";
}

echo "END-OF-LOG:\n";
$db->close();
?>
