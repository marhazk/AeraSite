Content:
/etc/crontab -> replace or edit your actual crontab
/scripts -> this folder with all scripts to update the sql tables
/sql -> this folder contain the sql tables
/var/www/top -> this folder contain the the webpage to show your ranking and contain also the pkupdate.php
/webapps/iweb -> this folder contain the pkupdate.jsp

Installation:
Put everything in the right folders and configure every files to match your actual server configs.

First use:
Go to the scripts folder and run every scripts like this:
./pkupdate
(wait few sec or minutes, depend how large is your kills.formatlog)
./pkupdate2
(wait few sec or minutes, depend how large is your mysql database)
./pkupdate3
(wait few sec or minutes, depend how large is your game database)