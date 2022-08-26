#!/bin/bash
echo "script started";
sudo mysqldump macrostroy_db > /var/www/www-root/data/www/artemy.net/mysql_backup.sql &&
sed -i '/^--/d' mysql_backup.sql &&
echo "mysql backup completed"
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net add --all &&
echo "files added";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net commit -m "miss server backup `date`" --all --author="Miss Server <server@artemy.net>" &&
echo "all files committed";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net push -u origin main &&
echo "pushed origin main";
echo "script executed";