#!/bin/bash
echo "script started";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net add --all &&
echo "added all";
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net commit -m "miss server backup `date`" --all --author="Miss Server <server@artemy.net>" &&
echo "committed all";
git config --global user.name "you name"
git config --global user.email you@domain.example
git --git-dir=/var/www/www-root/data/www/artemy.net/.git --work-tree=/var/www/www-root/data/www/artemy.net push -u origin main &&
git commit --amend --reset-author
echo "pushed origin main";
echo "script executed";