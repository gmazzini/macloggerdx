<?php

include("dati.php");
$conn=mysqli_connect($myhost,$myuser,$mypasswd,$mytable);

$res=mysqli_query($conn,"select count(distinct callsign) from qso where qrzmail=0 and length(email)>5");
$row=mysqli_fetch_assoc($res);
print_r($row);

mysqli_close($conn);

?>
