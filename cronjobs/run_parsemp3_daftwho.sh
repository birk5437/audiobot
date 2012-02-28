#!/bin/bash
cd /var/www/adhd4.me/www/audiobot/java/
date
java parseMp3DaftWho http://daftwho.com/ /var/www/adhd4.me/www/audiobot/files/
rm /var/www/adhd4.me/www/audiobot/files/*html*
