from multiprocessing import Process, Pool
import ssl, subprocess, M2Crypto, sys

if len(sys.argv) < 2 or sys.argv[1] == "help" or sys.argv[1] == "-h":
  print 'Usage: sslcheck.py file\n  <file>: contains one url to check per line\n  <help>: print this help text'
  #print 'Number of arguments:', len(sys.argv), 'arguments.'
  #print 'Argument List:', str(sys.argv)

else:
  def getcert(url):
    try:
      cert = ssl.get_server_certificate((url, 443))
      x509 = M2Crypto.X509.load_cert_string(cert)
      CN = x509.get_subject().as_text().split(' ')[-1]
      NA = x509.get_not_after()
      print "Result for %s: Expires on %s (%s)" % (url, NA, CN)
    except Exception, e:
      print "Failed: %s %s" % (url, e)
  
  #Format: urls = ['site3.com', 'site2.com', 'site3.com,']
  urls = open(sys.argv[1]).readlines()
  urls = map(lambda s: s.strip(), urls)
  
  pool = Pool(processes=len(urls))
  results = pool.map(getcert, urls)
  
  for result in results:
    print result
