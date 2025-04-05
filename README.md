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

+-------------------------------------------------------------------------------------------------------------+

Blade Directive	Purpose
@extends('layouts.base')	Inherits a layout from layouts/base.blade.php
@section('content')	Defines a section to be inserted into @yield('content')
@yield('content')	A placeholder in the layout for child views to insert content
@push('scripts')	Adds scripts to a stack, to be included in @stack('scripts')
@stack('scripts')	Displays all scripts pushed with @push('scripts')

+-------------------------------------------------------------------------------------------------------------+


