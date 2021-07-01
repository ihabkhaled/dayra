//Install first time
composer install
php artisan dayra:createdb
php artisan migrate
php artisan key:generate

php artisan db:seed --class=UsersSeeder
php artisan db:seed --class=InvoicesSeeder

//Modify .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dayra
DB_USERNAME=root
DB_PASSWORD=

php artisan serve

/////////////////////////////////////////////////////////////////////////
//Creating migrations and controllers
php artisan make:command dayra_db_create
php artisan migrate:rollback

php artisan make:migration create_invoices_table
php artisan make:migration create_users_table
php artisan make:controller InvoiceController --resource
php artisan make:controller UserController --resource

php artisan make:model User
php artisan make:model Invoice

php artisan make:seeder UsersSeeder
php artisan make:seeder InvoicesSeeder