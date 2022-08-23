1. запустить в консоли ./artemy update
2. поблагодарить Артемия

# Для лошков ебаных:
1. удалить generated-conf, generated-sql, Model, propel, propel.php, propel.php.dist
2. composer remove propel/propel
3. composer require "propel/propel: ~2.0@dev"

4. ln -s vendor/bin/propel propel


4. ./propel init

   31.31.196.31
   db name: u1520945_house
   db user: u1520945_house_a
   db password: bW5uO7nN8zjQ5w

5. schema.xml в папку /var/www/www-root/data/www/test.com
6. /Model/ в папку /var/www/www-root/data/www/test.com/Model/

7. В composer.json добавить "DB\\": "Model/DB/" в PSR-4

8. В главный index.php добавить require "generated-conf/config.php";