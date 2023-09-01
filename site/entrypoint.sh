#!/bin/bash

chown -R www-data:www-data /var/www/html/public/assets/img
chmod -R 755 /var/www/html/public/assets/img

# Puis, démarrez Apache en arrière-plan
apache2-foreground
