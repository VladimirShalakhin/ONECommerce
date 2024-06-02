<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/check_db_connection', function () {
    try {
        DB::connection()->getPDO();
        return "Соединение с БД успешно установлено";
    } catch(\Exception) {
        return "Соединение с БД не установлено";
    }
});
Route::get('/current_date', function () {
    return "Текущая дата (формат ДЕНЬ-МЕСЯЦ-ГОД ЧАС-МИНУТА-СЕКУНДА (ФОРМАТ 24-ЧАСОВОЙ)): " . date("d-m-Y H-i-s D");
});
Route::get('/redirect_to_first', function () {
    return Redirect::to('/check_db_connection');
});
