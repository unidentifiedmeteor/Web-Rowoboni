# Web-Rowoboni

# requirements
PHP
Composer
Node.js & npm
XAMPP

# cara setup
1. clone repo

Lalu di terminal ketik 
2. cd laravel
3. composer install
4. npm install

5. copy .env.example jadi .env (caranya di terminal ketik)
copy .env.example .env

6. Buka file env yang terbuat lalu bagian databasenya ini diisi gini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rowoboni
DB_USERNAME=root
DB_PASSWORD=

7. Lalu di terminal ketik
php artisan key:generate

8. Buat DB bernama rowoboni di phpmyadmin

9. Di terminal ketik
php artisan migrate


# cara jalankan
1. Buka terminal lalu ketik
npm run dev
2. Buka terminal BARU lalu ketik
php artisan serve
3. buka http://localhost:8000