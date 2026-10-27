FROM richarvey/nginx-php-fpm:latest

# Copiar el código del proyecto al directorio web de Nginx
COPY . /var/www/html
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-available/default.conf

# Configuración del servidor web Nginx y PHP
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV COMPOSER_ALLOW_SUPERUSER 1

# Configuración por defecto de Laravel en producción
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Permisos de carpetas de escritura
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod +x /var/www/html/scripts/00-laravel-deploy.sh

# Puerto estándar que expondrá el contenedor
EXPOSE 80

# Comando de inicio del contenedor (ejecuta Nginx, PHP-FPM y los scripts de /scripts)
CMD ["/start.sh"]
