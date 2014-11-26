#!/bin/bash
# run this script at login via your /etc/xdg/lxsession/LXDE/autostart file
# @lxterminal -e "sh /home/pi/MagicMirror/shell/autostart.sh"

# update the app
sh MagicMirror/shell/git-update.sh
# run needed scripts
sh MagicMirror/shell/run.sh
