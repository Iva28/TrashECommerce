<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

/* Artisan::command('demo', function () {
    config(['database.connections.mysql.database' => null]);
    DB::statement('CREATE DATABASE IF NOT EXISTS ecommercedb CHARACTER SET utf8 COLLATE utf8_unicode_ci');
    config(['database.connections.mysql.database' => 'ecommercedb']);
    DB::disconnect('mysql'); 
    Artisan::call('migrate');
    Artisan::call('db:seed');
}); */