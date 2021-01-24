<?php
// v1 by IK4LZH, usage: cd /$HOME/Documents/MLDX_Logs; php macloggerdx/today.php

$zz=strtotime("today midnight");
$db=new SQLite3("MacLoggerDX.sql");
$res = $db->query("SELECT count(qso_start) FROM qso_table_v007 where qso_start>=$zz");
$row = $res->fetchArray();
echo "QSOs: ".$row[0]."\n";
?>
