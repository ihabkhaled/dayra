//Install first time
composer install
php artisan dayra:createdb
php artisan migrate
php artisan db:seed --class=UsersSeeder

//Modify .env file
//modify mysql data with database name "dayra"
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dayra
DB_USERNAME=root
DB_PASSWORD=

//modify smtp server data to test emails
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=ENTER_EMAIL_SMTP_HERE
MAIL_PASSWORD=ENTER_PASSWORD_SMTP_HERE
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=ENTER_FROM_ADDRESS
MAIL_FROM_NAME="Test Dayra"

php artisan serve

//For errors
php artisan key:generate
php artisan config:cache
php artisan config:clear

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

php artisan make:mail InvoiceCreated --markdown=emails.invoice.created
php artisan make:mail UserCreated --markdown=emails.user.created