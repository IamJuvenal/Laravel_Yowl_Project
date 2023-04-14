FROM php:7.4-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql

# Copier le code source de l'application Laravel dans l'image Docker
COPY . /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html/

# Exposer le port 80
EXPOSE 80

