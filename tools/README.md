#HashtagSecurity Tools Collection
Sounds fancier than it is... a place for all my scripts and snippets

###haveibeenpwned
Is an old script to check hibp API for a list of emails and output the result as CSV

###abusix leakdb
was originally a script to request goog.li hash database, which is now leakdb.abusix.com. Haven't fixed the script to actually use their API (which they now have!)

###thinkpad x240 touchpad settings
suck on Kubuntu 14.04 so I created this startup script to set them to my likings, namely using only the buttons and disabling all touch except for a small square in the middle for two finger scrolling. I use the red nob (trackpoint) always anyways!

###ssl_date_checker.py
This is a script I wrote in order to check a bunch of urls or hosts in a file for their SSL cert expiry date. The problem was that I had a bunch of hosts listening on port 443 without proper SSL being configured which resulted in long timeouts and a very long sslscan runtime. So this script checks all of them at the same time, making the process much faster. 

    ssl_date_checker.py hosts.txt
