#!/bin/bash
echo "script started";
rm /var/www/www-root/data/www/artemy.net/branches/main/mysql_backup.sql &&
sudo mysqldump --skip-dump-date macrostroy_db > /var/www/www-root/data/www/artemy.net/branches/main/mysql_backup.sql &&
echo "mysql backup completed";
git --git-dir=/var/www/www-root/data/www/artemy.net/branches/main/.git --work-tree=/var/www/www-root/data/www/artemy.net/branches/main add --all &&
echo "files added";
git --git-dir=/var/www/www-root/data/www/artemy.net/branches/main/.git --work-tree=/var/www/www-root/data/www/artemy.net/branches/main commit -m "miss server backup `date`" --all --author="Miss Server <server@artemy.net>" &&
echo "all files committed";
git --git-dir=/var/www/www-root/data/www/artemy.net/branches/main/.git --work-tree=/var/www/www-root/data/www/artemy.net/branches/main push -u origin main &&
echo "pushed origin main";
echo "script executed";