#Define libraries
from gtts import gTTS 
import os
import sys

#Load arguments to varraibles
mytext = sys.argv[2]
language = sys.argv[1]

#Create audio file with responge
myobj = gTTS(text=mytext, lang=language, slow=False) 
myobj.save("rp.mp3") 