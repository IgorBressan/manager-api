<?php

use Illuminate\Support\Facades\Route;

use App\Services\Encrypt;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/teste', function () {

    // $date = new \DateTime('NOW');

    // $date = $date->format('u');

    // return Encrypt::encrypt($date);

    // $payload = 'Z3lRZ2pONVlQSjY3S0R2QXExRHU5dz09';

    // return Encrypt::decrypt($payload);

    $user = new User;

    $user->name('teste');

    return $user->getvalues();



});