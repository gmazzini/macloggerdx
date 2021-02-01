<?php
// v0 20210201 by IK4LZH

$db=new SQLite3("MacLoggerDX.sql");

$res = $db->query("SELECT call,band_tx,mode,qso_done,rst_sent,rst_received FROM qso_table_v007 order by qso_done limit 5");
while ($row = $res->fetchArray()) {
  
 echo $mode." "; // mode 2c+s
 $date=$row["qso_done"];
 echo date("Y-m-d Hi",$date)." "; // date time 15c+s

}

$db->close();
?>
