#!/bin/sh
find /var/www/adhd4.me/www/audiobot/files -name "*mp3" -mtime +8 -exec rm -f {} \; 
rm /var/www/adhd4.me/www/audiobot/files/audiobot_all.tar.gz
tar cvf /var/www/adhd4.me/www/audiobot/files/audiobot_all.tar /var/www/adhd4.me/www/audiobot/files/*.mp3
gzip /var/www/adhd4.me/www/audiobot/files/audiobot_all.tar

