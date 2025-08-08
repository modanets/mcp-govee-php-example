FROM php:8.3-cli

RUN apt update && apt install -y wget libzip-dev libsodium-dev unzip \
    && docker-php-ext-install zip sodium \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /app

# Copy source files
COPY . .

# Make server script executable
RUN chmod +x mcp-server.php

CMD ["php", "./mcp-server.php"]
