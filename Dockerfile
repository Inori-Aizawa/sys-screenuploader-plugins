FROM php:7.4-apache as base
# move the files
COPY ./ /var/www/html 
# create the log
RUN touch /var/www/html/log.log
# set the permissions
RUN chmod 777 /var/www/html/log.log
RUN chmod 777 /var/www/html/tmp
