#!/bin/bash
cd /root/programs/ParseMp3Java
date
java parseMp3 $1 /var/www/adhd4.me/www/audiobot/temp/
mv /var/www/adhd4.me/www/audiobot/temp/*.mp3 /var/www/adhd4.me/www/audiobot/files/
rm /var/www/adhd4.me/www/audiobot/temp/*html*
