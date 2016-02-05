#Introduction
This is a php-based dashboard that I created quickly to

- Restart services and check their status.Works with
  -  Sickbeard
  -  Couchpotato
  -  Rtorrent
  -  Plex
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

#Feature Requests
- Add more services
- Settings menu
-  Add subs download button 


#Issues you might face
1) Services do not start or stop
   Make sure that your user is included in the sudoers like show here: http://stackoverflow.com/questions/3173201/sudo-in-php-exec
  
   More specifically, you might need to add something like this 
   ```www-data ALL=(root) NOPASSWD: /usr/sbin/service``` where www-data is the web user
