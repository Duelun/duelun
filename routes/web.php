<?php

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
/*
Route::get('/', function () {
    return view('home');
});*/

Route::group(['middleware' => 'VisitorCounter'], function() {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('home');
    Route::get('/support', function() {
        return view('support');
    });
    Route::get('/legal', function() {
        return view('legal');
    });
    Route::get('/documents', [App\Http\Controllers\DocumentController::class, 'showAll'])->name('home');
    Route::get('/document/{folder}/{doc}', [App\Http\Controllers\DocumentController::class, 'showDocument'])->name('home');
    Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send'])->name('home');
    Auth::routes([
        'register' => false,
        'reset' => false,
        'vertify' => false,
    ]);
});

Route::group(['middleware' => 'VisitorCounter:0'], function() {
    Route::get('/api/beacon', function() {
        return "OK";
    });
});

Route::get('/api/lead_audit', ['middleware' => 'VisitAudit', function() {
    return "OK";
}]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index']);
    Route::post('/settings/save', [App\Http\Controllers\SettingsController::class, 'save'])->name('settings.save');

    Route::resource('posts', 'PostController');
    Route::resource('supporters', 'SupporterController');

    Route::post('supporters/moveUp/{id}', [App\Http\Controllers\SupporterController::class, 'moveUp'])->name('supporters.moveUp');
    Route::post('supporters/moveDown/{id}', [App\Http\Controllers\SupporterController::class, 'moveDown'])->name('supporters.moveDown');

    Route::get('/cmds/cache', function() {
        //Artisan::call('migrate');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
    
        return "Done";
    });
});