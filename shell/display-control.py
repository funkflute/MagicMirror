#!/usr/bin/python
'''
This script will use a PIR motion detector to check for lack of motion after
20 min and shut off the HDMI. it will re-enable the display when motion is
detected.
'''
import RPi.GPIO as GPIO
import time
import os
import json

class Object:
    def toJSON(self):
        return json.dumps(self, default=lambda o: o.__dict__, sort_keys=True, indent=4)

# read in config file
options = json.load(open('../config.json'))

# set your sensor pin here
sensorPin = options['pir_pin']
# minutes of non-motion until we disable HDMI
minUntilDisable = options['display_sleep']

GPIO.setmode(GPIO.BOARD)
GPIO.setup(sensorPin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)

data = Object()
data.active = True
data.timestamp = None

# other variables
CurrentState = 0
PreviousState = 0
startTime = 0
stopTime = 0

# set file to store
file = open('../display.json', mode='w')
file.write(data.toJSON())

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
      if data.active == False:
        # turn on display
        os.system("tvservice -p")
        # save/write data
        data.active = True
        data.timestamp = startTime
        file.write(data.toJSON())

    elif CurrentState==0 and PreviousState==1:
      # PIR has returned to ready state
      stopTime = time.time()
      PreviousState = 0
      elapsedTime = int(stopTime-startTime)
      print "-> Sensor was reset after: " + str(elapsedTime) + " secs"

    disableTime = int(time.time() - stopTime)
    # if time since end of motion is greater than X, and HDMI is on, turn it off
    if stopTime > 0 and disableTime > minUntilDisable * 60 and data.active == True:
      # turn off HDMI
      os.system("tvservice -o")
      # set/write data
      data.active = False
      data.timestamp = disableTime
      file.write(data.toJSON())

except KeyboardInterrupt:
  print "Quitting"
  # Reset GPIO settings
  GPIO.cleanup()

# make sure video is displayed on exit
if data.active == False:
  os.system("tvservice -p")
