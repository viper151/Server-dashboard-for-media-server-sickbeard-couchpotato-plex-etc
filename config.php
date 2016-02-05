<?php
$url="";
$user="";
$sbkey=exec("cat /home/".$user."/Sick-Beard/config.ini |  grep -e 'api_key' -m 1|awk '{print $3}'");
$sbport="8081";
$shellport="4200";
$cpport="5050";
$plexport="32400";


//Parameters
$services=array("sickbeard","plexmediaserver","shellinaboxd", "rtorrent",	"couchpotato");
?>
