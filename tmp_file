#!/usr/bin/python
#http://api.leakdb.abusix.com/?j=helloworld
import httplib, json
# Counter
with open("hashfile") as hashfile:
    for line, n in enumerate(hashfile):
        pass
      
progress = 1
counter = 0
counterpm = 0

#Open hashfile
with open("hashfile") as hashfile:
    for lines in hashfile:
	line =  lines.strip('\n')
	print line.split(':')
	#example string in file: ['admin', '1004', '472fc5917424e116a83a3d9bc8cfe8c6', '2b3cffea69ed2e43467595155dfa4f61', '', '', '']
	#examlple string in result: admin, 1004, 472fc5917424e116a83a3d9bc8cfe8c6, cleartextpassword (hashtype:2b3cffea69ed2e43467595155dfa4f61), '', '', ''
	
	
	#for string in line.array[] do
	for i in line.split(':'):
	    #split hashes by delimiter ":" into array and request leakdb if string => 32
	    if len(i) >= 32:
		print i
		url = "http://api.leakdb.abusix.com/?j="+i
		print url
		#requesting haveibeenpwned.com/api/breachedaccount/mailaddress
		httpServ = httplib.HTTPConnection("api.leakdb.abusix.com", 80)
		httpServ.connect()
		httpServ.request('GET',url)
		response = httpServ.getresponse().read()
		
		print response
		json_data = json.loads(response)
		print json_data
		#for j in json_data:
		    #print j['found']
		    #elif j == "type":
			#type == j.split('=')
		    #elif j == type[1]
		    
			
		
		    #if type == cleartext:
		        #somethings wrong, move along
		    #else:
			#update $i to be 'result (type:oldhash)'
	   #print line
	   #write line into resultfile
	
