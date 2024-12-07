FROM nginx:alpine

COPY phpdocker/nginx/nginx.conf /etc/nginx/conf.d/default.conf
WORKDIR "/var/www/html"
COPY . .
RUN chmod -R 755 .

EXPOSE 80

