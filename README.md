-- cabrillo.php -- php script to create a cabrillo log after or during a contest from macloggerdx database
-- today.php -- php script to count qso run today
-- duplicate -- script to remove duplicate qso in macloggerdx

Example of use starting from $HOME/Documents/MLDX_Logs
with both macloggerdx and ik4lzh gitthub repository from such a place
php macloggerdx/cabrillo.php > prova.cbr; cd ik4lzh; cat ../prova.cbr | php ubadx.php skip; cd ..
