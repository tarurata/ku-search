# Use the official PHP image with FPM
FROM php:7-fpm

# Set working directory
WORKDIR /var/www

# Copy the application code to the container
COPY . /var/www

# Expose port 9999 to the Docker host, so we can access it from the outside.
EXPOSE 9999

# Start the PHP-FPM server
CMD ["php-fpm"]
