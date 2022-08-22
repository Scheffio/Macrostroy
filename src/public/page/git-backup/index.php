<?php
var_dump(shell_exec('cd /var/www/www-root/data/www/artemy.net && git add --all && git commit -m "miss server backup `date`" --all && git push -u origin main'));
echo "script executed";

/////