# Use the official PHP image with FPM
FROM php:7-fpm

# Set working directory
WORKDIR /var/www

# Copy the application code to the container
COPY . /var/www

# Use sed to replace the listening port with the one Render expects
RUN sed -i 's/listen = 9000/listen = 10000/' /usr/local/etc/php-fpm.d/zz-docker.conf

# Expose port 10000 for Render to connect to
EXPOSE 10000

# Start the PHP-FPM server
CMD ["php-fpm"]
