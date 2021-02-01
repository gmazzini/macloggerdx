<?php
// v0 20210201 by IK4LZH

$db=new SQLite3("MacLoggerDX.sql");

$res = $db->query("SELECT call,band_tx,mode,qso_done,rst_sent,rst_received FROM qso_table_v007 order by qso_done limit 5");
while ($row = $res->fetchArray()) {
  $aux="insert into qso (callsign,band,mode,data,time,rst_sent,rst_rcvd) value 
  ('".$row["callsign"]."',".$row["band"].",'".$row["mode"]."','".date("Ymd",$row["qso_done"])."','"
  .date("His",$row["qso_done"])."','".$row["rst_sent"]."','".$row["rst_received"]."')";
  
  echo $aux;
echo "\n";

}

$db->close();
?>
