#!/usr/bin/python
import httplib
print "Warning, this script overwrites the file haveibeenpwned.csv if it already exists!\n"
print "Progress\tCompromised\tMailaddress"


#create result file (or overwrite if it already exists
head = "Mail, Adobe, Stratfor, Gawker, PixelFederation, Yahoo, Sony, Vodafone\n"
resultfile = open('haveibeenpwned.csv', 'w+')
resultfile.write(head)
resultfile.close()

with open("maillist") as maillist:
    for mailcount, n in enumerate(maillist):
        pass


#progress: mail [x/y]
progress= 1
#counter: x accounts have been compromised
counter = 0
#counter per mail: x account for mail@example.com have been compromised
counterpm = 0

with open("maillist") as maillist:

    for line in maillist:
        #setting site defaults to "no"
        adob,stra,gawk,pixf,yaho,sony,voda = "No, ","No, ","No, ","No, ","No, ","No, ","No"
    
        #preparing request url
        mail = line.strip('\n')
        url = "/api/breachedaccount/"+mail
    
        #requesting haveibeenpwned.com/api/breachedaccount/mailaddress
        httpServ = httplib.HTTPConnection("haveibeenpwned.com", 80)
        httpServ.connect()
        httpServ.request('GET',url)
        response = httpServ.getresponse().read()
   	counterpm = 0 
        #Checking response for every leaked site
        for i in response.split(','):
            j = i.strip('[]"')
            if j == "Adobe":
                adob = "Yes, "
                counter = counter+1
                counterpm = counterpm+1
            elif j == "Stratfor":
                stra = "Yes, "
                counter = counter+1
                counterpm = counterpm+1
            elif j == "Gawker":
                gawk = "Yes, "
                counter = counter+1
                counterpm = counterpm+1
            elif j == "PixelFederation":
                pixf = "Yes, "
                counter = counter+1
                counterpm = counterpm+1
            elif j == "Yahoo":
                yaho = "Yes, "
                counter = counter+1
                counterpm = counterpm+1
            elif j == "Sony":
                sony = "Yes"
                counter = counter+1
                counterpm = counterpm+1
            elif j == "Vodafone":
                sony = "Yes"
                counter = counter+1
                counterpm = counterpm+1
        
        #print progress and requested mail
        mailcount_str = str(mailcount+1)
        progress_str = str(progress)
	counterpm_str = str(counterpm)
        print "["+progress_str+"/"+mailcount_str+"]\t\t"+counterpm_str+"\t\t"+mail
        progress = progress+1 #have to convert them to strings.... :(
    
        #write result file haveibeenpwned.csv
        result = mail+", "+adob+stra+gawk+pixf+yaho+sony+voda
        resultfile = open('haveibeenpwned.csv', 'a+')
        resultfile.write(result+"\n")
        resultfile.close()
    
        httpServ.close()
    

    counter_str = str(counter)
    print "\n\nNumber of compromised accounts found: "+counter_str
    print "Please check haveibeenpwned.csv for detailed results"
