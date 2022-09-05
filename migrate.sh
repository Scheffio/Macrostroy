#!/bin/bash
#HAS_UNFINISHED_MIGRATIONS=`find ./generated-migrations -type d -empty -exec command1 arg1 {} \`;
if [ -n "$(ls -A ./generated-migrations)" ]; then
  echo You have uncommited migrations. What to do?;
PS3='Please enter your choice: '
options=("Commit previous migrations" "Delete previous migrations" "Quit")
select opt in "${options[@]}"
do
    case $opt in
        "Commit previous migrations")
            echo "you chose choice 1"
            ;;
        "Delete previous migrations")
            echo "you chose choice 2"
            ;;
        "Quit")
            break
            ;;
        *) echo "invalid option $REPLY";;
    esac
done
fi
#rm -rf ./generated-migrations
#echo creating migration to DATABASE from schema.xml
#./propel diff
#
#PS3='Please enter your choice: '
#options=("Option 1" "Option 2" "Option 3" "Quit")
#select opt in "${options[@]}"
#do
#    case $opt in
#        "Option 1")
#            echo "you chose choice 1"
#            ;;
#        "Option 2")
#            echo "you chose choice 2"
#            ;;
#        "Option 3")
#            echo "you chose choice $REPLY which is $opt"
#            ;;
#        "Quit")
#            break
#            ;;
#        *) echo "invalid option $REPLY";;
#    esac
#done