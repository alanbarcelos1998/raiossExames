# Use a imagem oficial do PHP com Apache
FROM php:8.1-apache-bullseye

# Atualize os pacotes e instale o mod_rewrite
RUN apt-get update && \
   a2enmod rewrite

RUN docker-php-ext-install pdo_mysql

# Copie o arquivo .htaccess para o diretório raiz do Apache
COPY ./.htaccess /var/www/html/

# Copie o resto do seu aplicativo para o diretório raiz do Apache
COPY . /var/www/html/

# Exponha a porta 80
EXPOSE 85

# Inicie o Apache
CMD ["apache2-foreground"]
