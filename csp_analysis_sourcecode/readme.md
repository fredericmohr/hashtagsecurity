# Apache VHOST used for this csp attack analysis
 Blogpost can be found at https://www.hashtagsecurity.com/csp

 Questions to @HashtagSecurity on twitter.

    ########################################
    #   CSP Attack - Vulnerable Examples   #
    ######################################## 
    <VirtualHost *:80>
    ServerAdmin admin@yourserver.com
    ServerName cspanalysis.yourserver.com
    
    DocumentRoot /var/www/csp_analysis
    
    Header always set Content-Security-Policy: "default-src 'self'; object-src 'self' data:; script-src 'self' data:; report-uri http://cspanalysis.yourserver.com/reportv.php;"
    
    # Older CSP header for tests with old firefox versions
    Header always set X-Content-Security-Policy: "default-src 'self'; object-src 'self' data:; script-src 'self' data:; report-uri http://cspanalysis.yourserver.com/reportv.php;"
    
    <Directory /var/www/csp_analysis >
            Options FollowSymLinks MultiViews
            AuthType Basic
            AuthName "private area"
            AuthBasicProvider file
            AuthUserFile /path/to/your/.htpasswd
            Require valid-user
    
    
    <Files "reportv.php">
         Order allow,deny
         Allow from all 
         Satisfy any
    </Files>
    
    </Directory>
    # Log Files
    ErrorLog /var/log/apache2/csp_error.log
    LogLevel warn
    CustomLog /var/log/apache2/csp_access.log combined
    
    </VirtualHost>
