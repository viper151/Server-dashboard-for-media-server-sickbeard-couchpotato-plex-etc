#Introduction
This is a php-based dashboard that I created quickly to

- Restart services and check their status. Works with
  -  Sickbeard
  -  Couchpotato
  -  Rtorrent
  -  Plex
  -  Transmission (thanks to Truks89)
- See the upcoming shows from sickbeard
- See quick server statistics (server load, hdd space and RAM)


![alt text](http://i.imgur.com/NqCbEY7.png)


#Instructions

1) Install it by cloning this repository
```
git clone https://github.com/viper151/Server-dashboard-for-media-server-sickbeard-couchpotato-plex-etc-.git dashboard 
```

(or you can use your own folder instead of "dashboard")

2) Add your username, hostname, sickbeard folder and the correct ports in config.php

3) Remove the services you do not use from config.php

#Add your own services
Apart from the officially supported applications, you can add your own applications and services.
In order to do so, you have to adjust two files.

1) ajax.php 
If the application does not have a service or does not have belong to the list of services that can be restarted with
sudo -u $user service {servicename} start/stop
then you need to add the following at line 15 after the closing "}"
``` else if ($_GET["service"]==="transmission") {
		$specificmessage="";
	}```
and in the $specific message, add the start/stop command for the service itself.

2) config.php
Under the $services array, make sure to add the application's name

#Integrate with Muximux

Can easily be integrated with Muximux (https://github.com/mescon/Muximux) by simply adding the url of your dashboard into Muximux's settings
![alt text](http://i.imgur.com/qvc8eHr.png)


#Feature Requests
- Add more services
- Settings menu
-  Add subs download button 


#Issues you might face
1) Services do not start or stop
   Make sure that your user is included in the sudoers like show here: http://stackoverflow.com/questions/3173201/sudo-in-php-exec
  
   More specifically, you might need to add something like this 
   ```www-data ALL=(root) NOPASSWD: /usr/sbin/service``` where www-data is the web user
