#!/bin/bash

cd /home/pi/MagicMirror
/usr/bin/git reset --hard master
/usr/bin/git pull
/usr/bin/git checkout master
