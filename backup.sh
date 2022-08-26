#!/bin/bash
now=$(date +'%S:%M:%H %m.%d.%Y');
echo "script started";
sudo mysqldump macrostroy_db > /var/www/www-root/data/www/artemy.net/mysql_backup_"$now".sql &&
echo "mysql backup completed"
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net add --all &&
echo "added all";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net commit -m "miss server backup `date`" --all --author="Miss Server <server@artemy.net>" &&
echo "committed all";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net push -u origin main &&
echo "pushed origin main";
echo "script executed";