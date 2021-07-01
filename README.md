php artisan make:command dayra_db_create
php artisan dayra:createdb

php artisan migrate:rollback
php artisan migrate

php artisan make:migration create_invoices_table
php artisan make:migration create_users_table
php artisan make:controller InvoiceController --resource
php artisan make:controller UserController --resource

php artisan make:model User
php artisan make:model Invoice

php artisan make:seeder UsersSeeder
php artisan db:seed --class=UsersSeeder