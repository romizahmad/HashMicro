<?php

use App\Http\Controllers\CompareController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.welcome');
});

Route::resource("students", StudentController::class);
Route::resource("graduates", GraduateController::class);

Route::prefix('compare')->group(function () {
    Route::get("form", [CompareController::class, "showForm"])->name("input.form");
    Route::post("calculate", [CompareController::class, "compareInputs"])->name("input.compare");
});
