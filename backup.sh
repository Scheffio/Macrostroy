#!/bin/bash
echo "script started";
git config --global user.name "Miss Server" &&
echo "Configured name as Miss Server";
git config --global user.email server@artemy.net &&
echo "Configured email as server@artemy.net";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net add --all &&
echo "added all";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net commit -m "miss server backup `date`" --all &&
echo "committed all";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net push -u origin main &&
echo "script executed";