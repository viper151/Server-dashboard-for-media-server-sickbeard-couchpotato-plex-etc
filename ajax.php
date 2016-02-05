<?php
require 'config.php';

//Subs
if(isset($_GET['subs']) && !empty($_GET['subs'])) {
	$message=var_dump(exec("sudo -u".$user." subliminal -l en -- /home/". $_GET['folder']."/* 2>&1"));
	print_r($message);
};

//Start/Stop Services
if(isset($_GET["service"]) && !empty($_GET["service"])) {

	if ($_GET["service"]==="shellinaboxd" || $_GET["service"]==="plexmediaserver") {
		$specificmessage="sudo service ". $_GET["service"]." ".$_GET["action"]." 2>&1;";

	} else {
		$specificmessage="sudo -u ".$user." service ". $_GET["service"]." ".$_GET["action"]." 2>&1;";
};
	$message=exec($specificmessage);
	//echo $_GET["service"]." ".$_GET["action"]."ed";
	print_r($message);
};

//status
if (isset($_GET["servicestatus"])){
	exec("pgrep -fl ". $_GET["servicestatus"]." | grep -v sh", $output,$retval);

	echo $retval;//0 is running, 1 is down
};

?>

