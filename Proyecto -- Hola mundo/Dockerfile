# ══════════════════════════════════════════════════════════════
#  Imagen base: PHP 8.2 con Apache integrado
# ══════════════════════════════════════════════════════════════
FROM php:8.2-apache

# Instalar extensión PDO MySQL (necesaria para conectar a MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar módulo rewrite de Apache (buenas prácticas)
RUN a2enmod rewrite

# Copiar código fuente al directorio raíz de Apache
COPY src/ /var/www/html/

# Permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto 80
EXPOSE 80
