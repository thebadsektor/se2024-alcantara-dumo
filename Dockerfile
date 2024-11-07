FROM php:8.1-apache

# Install the necessary PHP extensions (pdo_mysql and mysqli)
RUN docker-php-ext-install pdo_mysql mysqli && docker-php-ext-enable pdo_mysql mysqli

# Enable the Apache rewrite module
RUN a2enmod rewrite

# Copy the custom Apache configuration file (if needed)
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy the entire project directory into the container
COPY . /var/www/html/

# Change ownership and permissions for the project directory
RUN chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/
