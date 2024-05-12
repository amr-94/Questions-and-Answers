<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

route::group([
    'middleware' => ['locale'],
], function () {

    route::prefix('/')->group(function () {
        Route::get('/tags', [TagsController::class, 'index'])->name('tags.index')->middleware('admin:admin');
        Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create')->middleware('admin:admin');
        Route::post('/tags', [TagsController::class, 'store']);
        Route::get('/tags/edit/{id}', [TagsController::class, 'edit'])->name('tags.edit')->middleware('admin:admin');
        route::put('/tags/{id}', [TagsController::class, 'update']);
        Route::delete('/tags/{id}', [TagsController::class, 'destroy'])->name('tags.delete')->middleware('admin:admin');
    });

    route::get('/', [QuestionsController::class, 'index'])->name('questions.index');
    route::resource('/questions', QuestionsController::class);
    route::get('notifications', [NotificationController::class, 'index'])->name('notifications')->middleware('auth');
    route::delete('notifications/delete/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy')->middleware('auth');
    route::delete('notifications/deleteall/', [NotificationController::class, 'destroyall'])->name('notification.destroyall')->middleware('auth');




    Route::get('alluser', [UserProfileController::class, 'index'])->middleware('admin:admin', 'auth')->name('all.user');
    Route::put('alluser/admin/{id}', [UserProfileController::class, 'makeadmin'])->middleware('admin:admin', 'auth')->name('user.change');
    Route::delete('user/{id}', [UserProfileController::class, 'destroy'])->middleware('admin:admin', 'auth')->name('user.delete');


    route::get('user/edit/profile', [UserProfileController::class, 'edit'])->name('user.edit')->middleware('auth');
    Route::put('user/update', [UserProfileController::class, 'update'])->name('user.update')->middleware('auth');
    route::get('user/profile/{id}', [UserProfileController::class, 'show'])->name('show.user');
    route::post('add/answer', [AnswersController::class, 'store'])->name('answers.store')->middleware('auth');
    route::put('answer/{id}/best', [AnswersController::class, 'best'])->name('answers.best')->middleware('auth');
    route::delete('answer/{id}/delete', [AnswersController::class, 'destroy'])->name('answers.destroy')->middleware('auth');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'password.confirm'])->name('dashboard');


require __DIR__ . '/auth.php';
