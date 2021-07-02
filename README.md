//Install first time
composer install
//create db if not exists
php artisan dayra:createdb
//run migrations
php artisan migrate
//run seeder
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

//run server
php artisan serve

php artisan key:generate
php artisan config:cache
php artisan config:clear

/////////////////////////////////////////////////////////////////////////

APIs instructions

Create User
http://127.0.0.1:8000/user/create
Body Keys:
    Required:
        email (Should be unique)
        full_name
        mobile (Should be unique)

Create Invoice
http://127.0.0.1:8000/invoice/create
Body Keys:
    Required:
        -email (Should match the existing user, If the email matches the user data will be automatically populated regardless to the full_name and mobile sent during the hitting)
        -amount
        -invoice_data (yyyy-mm-dd)
    In case email doesn't match any record the below keys will be mandatory in addition to the above ones:
        -full_name
        -mobile (Should be unique)
