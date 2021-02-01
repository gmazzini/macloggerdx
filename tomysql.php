<?php
// v0 20210201 by IK4LZH
$xx="20201220";

$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);
$zz=mktime(0,0,0,substr($xx,4,2),substr($xx,6,2),substr($xx,0,4));
$db=new SQLite3("MacLoggerDX.sql");
$res = $db->query("SELECT call,band_tx,mode,qso_done,rst_sent,rst_received FROM qso_table_v007 where qso_done>$zz limit 30");
while ($row = $res->fetchArray()) {
  $aux="insert into qso (callsign,band,mode,data,time,rst_sent,rst_rcvd) value ".
  "('".$row["call"]."',".substr($row["band_tx"],0,-1).",'".$row["mode"]."','".date("Ymd",$row["qso_done"])."','".
  date("His",$row["qso_done"])."','".$row["rst_sent"]."','".$row["rst_received"]."')";
  
  mysqli_query($conn,$aux);
  echo "$aux\n";

}

$db->close();
mysqli_close($conn);
?>
