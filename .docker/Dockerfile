# Use the official PHP 8.0 Apache image
FROM php:8.0-apache

# Switch to the root user to perform installations
USER root

# Set the working directory
WORKDIR /var/www/html

# Install required packages and extensions
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip && \
    docker-php-ext-configure gd && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install mysqli pdo_mysql zip && \
    a2enmod rewrite && \
    apt-get clean && \
    docker-php-source delete && \
    rm -rf /var/lib/apt/lists/*

# Install Node.js and npm from official image
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get update && \
    apt-get install -y nodejs && \
    npm install -g npm

# COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the environment variables
ENV PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/usr/local/node/bin"

# Create a non-root user to run Composer and Artisan commands
ARG USER_ID
ARG GROUP_ID
ENV USER_ID ${USER_ID:-1000}
ENV GROUP_ID ${GROUP_ID:-1000}
RUN groupadd --force -g $GROUP_ID laravel && \
    useradd -ms /bin/bash --no-user-group -u $USER_ID -g $GROUP_ID laravel

# Set the ownership of the Laravel project files to the non-root user
RUN chown -R laravel:laravel /var/www/html

# Switch to the non-root user
USER laravel

# Start Apache
CMD ["apache2-foreground"]

# Copy custom entrypoint script to container
COPY .docker/docker-entrypoint.sh /usr/local/bin/

ENV PORT = 8080

# Set entrypoint command
ENTRYPOINT ["docker-entrypoint.sh"]