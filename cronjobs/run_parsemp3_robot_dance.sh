#!/bin/bash
cd /var/www/adhd4.me/www/audiobot/java
date
java parseMp3_robot_dance http://www.robotdancemusic.com/ /var/www/adhd4.me/www/audiobot/files/
rm /var/www/adhd4.me/www/audiobot/files/*html*
