import RPi.GPIO as GPIO
import time
import ibmiotf.device
import os

GPIO.setmode(GPIO.BCM)

TRIG = 23 
ECHO = 24
tankMaxSize =150

thrs=10   #threshold for accyracy loop

options = {
    "org": "e8p31k",
    "type": "Sensor",
    "id": "water_sensor",
    "auth-method":"token" ,
    "auth-token": "nC?pWlPL98YBT(kYDw",
    "clean-session": "true"
  }


def sensorRead():

  GPIO.output(TRIG, True)
  time.sleep(0.00001)
  GPIO.output(TRIG, False)


  while GPIO.input(ECHO)==0:
     pulse_start = time.time()

  while GPIO.input(ECHO)==1:
     pulse_end = time.time()

  pulse_duration = pulse_end - pulse_start

  distance = pulse_duration * 17150

  distance = round(distance, 2)

  return distance

def cloudup(cloudthing):
        client = ibmiotf.device.Client(options)
        client.connect()
        print "Distance:",cloudthing,"cm  published"
        myData={'Waterlvl':cloudthing}
        client.publishEvent("status","json", myData)
        client.disconnect()

try :

  GPIO.setup(TRIG,GPIO.OUT)
  GPIO.setup(ECHO,GPIO.IN)

  GPIO.output(TRIG, False)
  print "Waiting For Sensor To Settle"
  time.sleep(2)
  while 1 :
    firstRead = sensorRead()
    time.sleep(5)
    secondRead = sensorRead()
    print "First Read:",firstRead,"cm"
    print "Second Read:",secondRead,"cm"

 
    if (int(secondRead)  in range(int(firstRead)- thrs, int(firstRead)+ thrs))and (int(secondRead) <= tankMaxSize) :  
                               cloudup(tankMaxSize - secondRead)
                             
    else:
                                print "Fake Sensor Read"
 
    time.sleep(2)         
    print '------------------------------------------------------------'               
except :
       GPIO.cleanup()
       os.system('sudo python tank.py')

