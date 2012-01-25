#!/bin/bash
cd /var/www/adhd4.me/www/audiobot/files

ls | while read -r FILE
do
    mv -v "$FILE" `echo $FILE | tr -s '%20' '_' `
done

#ls | while read -r FILE
#do
#    mv -v "$FILE" `echo $FILE | tr -d '_' `
#done
