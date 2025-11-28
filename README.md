# CapitalPOS
Pos para ventas 

# Iniciae
composer install  \
docker compose up -d

# Si no quedan los permisos
docker compose exec laravel.test bash \
rm -rf storage/framework/views/*.php \
php artisan view:clear \
php artisan cache:clear \
php artisan config:clear \
php artisan route:clear \
exit

# Crear y migrar bd inicial
./vendor/bin/sail artisan migrate  \
./vendor/bin/sail artisan db:seed 