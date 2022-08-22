#!/bin/bash
echo "script started";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net add --all &&
echo "added all";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net commit -m "miss server backup `date`" --all --amend --reset-author --no-edit &&
echo "committed all";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net push -u origin main &&
echo "pushed origin main";
echo "script executed";