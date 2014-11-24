#!/usr/bin/python
'''
This script will use a PIR motion detector to check for lack of motion after
X min and shut off the HDMI. It will re-enable the display when motion is
detected.
'''
import RPi.GPIO as GPIO
import time
import os
import json
from os import path

# allow to easily create JSON string
class Object:
    def toJSON(self):
        return json.dumps(self, default=lambda o: o.__dict__, sort_keys=True, indent=4)

# get root path
root_path = os.path.dirname(os.path.dirname(__file__)) + '/'

# files to read/write
options_file = root_path + 'config.json'
display_file = root_path + 'display.json'

def writeJSON(data):
  # set to write to display file, right now
  file = open(display_file, mode='w')
  data.timestamp = time.time()
  file.write(display.toJSON())
  file.close()
  return

# read in config file
options = json.load(open(options_file))

# set sensor pin
sensorPin = options['pir_pin']
# minutes of non-motion until we disable HDMI
minUntilDisable = options['display_sleep']

GPIO.setmode(GPIO.BOARD)
GPIO.setup(sensorPin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)

display = displayDefault = Object()
display.active = True
writeJSON(display)

# variables
CurrentState = 0
PreviousState = 0
startTime = 0
stopTime = time.time()

try:

  print "MagicMirror HDMI Disabler"
  print "-> Waiting for PIR to settle..."

  # Loop until PIR output is 0
  while GPIO.input(sensorPin)==1:
    CurrentState = 0

  print "-> Ready to detect motion"

  # Loop until users quits with CTRL-C
  while True:

    # Read PIR state
    CurrentState = GPIO.input(sensorPin)

    if CurrentState == 1 and PreviousState == 0:
      # PIR is triggered
      print "-> Motion detected!"
      # Record previous state
      PreviousState = 1
      # time of motion
      startTime = time.time()
      # if HDMI is off and motion is detected, turn it back on
      if display.active == False:
        # turn on display
        os.system("tvservice -p")
        # set/write data
        display.active = True
        writeJSON(display)

    elif CurrentState==0 and PreviousState==1:
      # PIR has returned to ready state
      stopTime = time.time()
      PreviousState = 0
      elapsedTime = int(stopTime-startTime)
      print "-> Sensor was reset after: " + str(elapsedTime) + " secs"

    # if time since end of motion is greater than X, and HDMI is on, turn it off
    if stopTime > 0 and int(time.time() - stopTime) > minUntilDisable * 60 and display.active == True:
      # turn off HDMI
      os.system("tvservice -o")
      # set/write data
      display.active = False
      writeJSON(display)

except:
  print "Quitting"
  # Reset GPIO settings
  GPIO.cleanup()
  # make sure video is displayed on exit
  if display.active == False:
    os.system("tvservice -p")
    writeJSON(displayDefault)
