import RPi.GPIO as GPIO
import time
import ibmiotf.device
import os
import sys
import datetime
import urllib2

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

TRIG = 23 
ECHO = 24
tankMaxSize =80
fakeRead = 24
nearempty = 101

thrs=5   #threshold for accyracy loop

options = {
    "org": "3i2tk4",
    "type": "water_sensor",
    "id": "HQ12",
    "auth-method":"token" ,
    "auth-token": "GIgR0Nk*@vo&@k34M4",
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

def netcheck ():
  counterck = 1
  loop_value = 1
  while (loop_value == 1):
        try:
            urllib2.urlopen("https://console.bluemix.net/")
            print " network connected"
            loop_value = 0

        except urllib2.URLError, e:
            loop_value = 1
            if (counterck <6):
                file=open("/home/pi/NET_tankTask_ErrorLog_HQ12.txt","a")
                file.write("Network currently down.")
                ts = time.time()
                sttime = datetime.datetime.fromtimestamp(ts).strftime('%d-%m-%Y   %H:%M:%S')
                file.write("\n"+sttime+"\n------------------------------------------------------\n")
                file.close()
                print "Network currently down."
	    	time.sleep(36)
	    	counterck=counterck+1
	    else:
            	file=open("/home/pi/NET_tankTask_ErrorLog_HQ12.txt","a")
            	file.write("Network was down for the last 5 min, Abort the program")
            	ts = time.time()
            	sttime = datetime.datetime.fromtimestamp(ts).strftime('%d-%m-%Y   %H:%M:%S')
            	file.write("\n"+sttime+"\n------------------------------------------------------\n")
            	file.close()
	    	sys.exit()

try :

  GPIO.setup(TRIG,GPIO.OUT)
  GPIO.setup(ECHO,GPIO.IN)

  GPIO.output(TRIG, False)
  print "Waiting For Sensor To Settle"
  time.sleep(30)
  x=0
  fakeck=1
  while (x==0):
   netcheck ()
   firstRead = sensorRead()
   time.sleep(5)
   secondRead = sensorRead()
   print "First Read:",firstRead,"cm"
   print "Second Read:",secondRead,"cm"

 
   if (int(secondRead)  in range(int(firstRead)- thrs, int(firstRead)+ thrs))and (int(secondRead) <= tankMaxSize+fakeRead) and (int(secondRead)>fakeRead-1) :
     if (secondRead>nearempty):
       cloudup(0)
     elif (secondRead<fakeRead+2):
       cloudup(tankMaxSize)
     else:
       cloudup((tankMaxSize - secondRead)+ fakeRead)
     x=1
   else:
     if (fakeck<6):
       print "Fake Sensor Read"
       text_file=open("/home/pi/tankTask_ErrorLog_HQ12.txt","a")
       ts = time.time()
       sttime = datetime.datetime.fromtimestamp(ts).strftime('%d-%m-%Y   %H:%M:%S')
       text_file.write("Fake Sensor Read"+"   -   "+sttime+"\n -------------------------\n")
       text_file.close()
       x=0
       fakeck=fakeck+1
       time.sleep(30)
     else:
       print "Fake sensor reads for the last 5 min, Abort the program"
       text_file=open("/home/pi/tankTask_ErrorLog_HQ12.txt","a")
       ts = time.time()
       sttime = datetime.datetime.fromtimestamp(ts).strftime('%d-%m-%Y   %H:%M:%S')
       text_file.write("Fake sensor reads for the last 5 min, Abort the program"+"   -   "+sttime+"\n -------------------------\n")
       text_file.close()
       sys.exit()
       
except Exception as e:
       text_file=open("/home/pi/tankTask_ErrorLog_HQ12.txt","a")
       ts = time.time()
       sttime = datetime.datetime.fromtimestamp(ts).strftime('%d-%m-%Y   %H:%M:%S')
       text_file.write(str(e)+"   -   "+sttime+"\n -------------------------\n")
       text_file.close()
       GPIO.cleanup()
       os.system('sudo python /home/pi/tankTask.py')
