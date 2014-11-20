#!/usr/bin/python
'''
This script will use a PIR motion detector to check for lack of motion after
20 min and shut off the HDMI it will re-enable the display when motion is
detected and repeat the process
'''
import RPi.GPIO as GPIO
import time
import os

# set your sensor pin here
sensorPin = 7
# minutes of non-motion until we disable HDMI
minUntilDisable = 20

GPIO.setmode(GPIO.BOARD)
GPIO.setup(sensorPin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)

#file = open('has-motion.json',mode='w')

# other variables
HDMI = 1
CurrentState = 0
PreviousState = 0
startTime = 0
stopTime = 0

try:

  print "MagicMirror HDMI Disabler"
  print "-> Waiting for PIR to settle..."

  # Loop until PIR output is 0
  while GPIO.input(sensorPin)==1:
    CurrentState = 0

  print "-> Ready to detect motion"

  # Loop until users quits with CTRL-C
  while True :

    # Read PIR state
    CurrentState = GPIO.input(sensorPin)

    if CurrentState == 1 and PreviousState == 0:
      # PIR is triggered
      startTime = time.time()
      print "-> Motion detected!"
      # Record previous state
      PreviousState = 1
      # if HDMI is off and motion is detected, turn it back on
      if HDMI == 0:
        os.system("tvservice -p")
        HDMI = 1
        stopTime = 0

    elif CurrentState==0 and PreviousState==1:
      # PIR has returned to ready state
      stopTime = time.time()
      # file.write(str(stopTime))
      PreviousState = 0
      elapsedTime = int(stopTime-startTime)
      print "-> Sensor was reset after: " + str(elapsedTime) + " secs"

    # if time since end of motion is greater than X, and HDMI is on, turn it off
    if stopTime > 0 and int(time.time() - stopTime) > minUntilDisable * 60 and HDMI == 1:
      # turn off HDMI
      os.system("tvservice -o")
      HDMI = 0

except KeyboardInterrupt:
  print "Quitting"
  # Reset GPIO settings
  GPIO.cleanup()

# make sure video is displayed on exit
if HDMI == 0:
  os.system("tvservice -p")
