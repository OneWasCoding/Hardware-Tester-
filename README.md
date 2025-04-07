+-------------------------------------------------------------------------------------------------------------+

We will be using Laravel framework ^11.0.  

To install and ensure that Laravel is version ^11.0, follow these steps:  

1. Install Laravel Installer with a specific version by running:  
   **composer global require laravel/installer:^11.0**  
   If you don’t specify the version, Laravel 12.0 will be installed by default.  

2. Check the installed Laravel version:  
   - Open the **composer.json** file and check the **laravel/framework** version.  
   - Alternatively, run **php artisan --version** in the terminal.  
   If it shows Laravel 12.0, you need to downgrade it to 11.0.  

3. Downgrade Laravel to version 11.0:  
   - Run **composer require laravel/framework:^11.0 --with-all-dependencies**  
   - Or manually update the **laravel/framework** version in **composer.json**, then run **composer update**.

+-------------------------------------------------------------------------------------------------------------+

   libraries to install:
   composer require "maatwebsite/excel:^3.1"
   composer require yajra/laravel-datatables-oracle
   composer require yajra/laravel-datatables-buttons
   composer require laravel/ui
   composer require spatie/laravel-ignition --no-interaction
   composer require laravel/scout
   composer require railsware/mailtrap-php symfony/http-client nyholm/psr7
   composer require consoletvs/charts


   bash:
   php artisan vendor:public --provider="Laravel\Scout\ScoutServiceProvider"
    php artisan scout:import "App\Models\items"


+-------------------------------------------------------------------------------------------------------------+

Blade Directive	Purpose
@extends('layouts.base')	Inherits a layout from layouts/base.blade.php
@section('content')	Defines a section to be inserted into @yield('content')
@yield('content')	A placeholder in the layout for child views to insert content
@push('scripts')	Adds scripts to a stack, to be included in @stack('scripts')
@stack('scripts')	Displays all scripts pushed with @push('scripts')

+-------------------------------------------------------------------------------------------------------------+


ENV configuration
+-------------------------------------------------------------------------------------------------------------+
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=leviashpenaverde@gmail.com
MAIL_PASSWORD=bpvfrkrylwpkusty

MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=leviashpenaverde@gmail.com
MAIL_FROM_NAME="Haven"








APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:aWahQGYB9nGwydtIQKGkp2eDEQcnoJnWvahMy303Hbg=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=haven
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=leviashpenaverde@gmail.com
MAIL_PASSWORD=bpvfrkrylwpkusty

MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=leviashpenaverde@gmail.com
MAIL_FROM_NAME="Haven"


AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
SCOUT_DRIVER=database