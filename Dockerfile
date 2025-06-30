FROM php:8.2-cli

WORKDIR /app
COPY . .

# Install extensions if needed (like mysqli, pdo, etc.)
RUN docker-php-ext-install mysqli

# Start PHP's built-in server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
