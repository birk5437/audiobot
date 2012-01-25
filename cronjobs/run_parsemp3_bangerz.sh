#!/bin/bash
cd /var/www/bangerz
wget http://www.bangerzonly.com/
cd /root/programs/ParseMp3Java
date
java parseMp3 http://dilutionofprecision.com/bangerz/index.html /var/www/adhd4.me/www/audiobot/files/
rm /var/www/adhd4.me/www/audiobot/files/*html*
rm /var/www/bangerz/*
