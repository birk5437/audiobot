#!/bin/sh
find /var/www/adhd4.me/www/audiobot/files -name "*mp3" -mtime +61 -exec rm -f {} \; 
rm /var/www/adhd4.me/www/audiobot/files/audiobot_all.tar.gz
cd /var/www/adhd4.me/www/audiobot/files/
#tar cvf audiobot_all.tar *.mp3
#gzip audiobot_all.tar

