# Usamos una imagen reciente de PHP con FPM
FROM php:8.3-fpm-alpine

# Instala las extensiones PHP necesarias (pdo_mysql es crucial para la DB)
# y limpia el caché para reducir el tamaño de la imagen.
RUN docker-php-ext-install pdo pdo_mysql mysqli \
    && rm -rf /tmp/*
