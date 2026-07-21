FROM php:8.3-apache

# Instalacija neophodnih ekstenzija za rad sa MySQL bazom
RUN docker-php-ext-install pdo pdo_mysql

# Omogućavanje Apache mod_rewrite za lepe URL rute
RUN a2enmod rewrite

# Kopiranje projekta u kontejner
COPY . /var/www/html/

# Postavljanje radnog direktorijuma
WORKDIR /var/www/html