<?php
var_dump(shell_exec('cd /var/www/www-root/data/www/artemy.net && git commit -m "miss server backup `date`" --all &&  git push origin backup'));
echo "script executed";

///