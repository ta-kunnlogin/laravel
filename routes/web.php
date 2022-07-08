<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;

use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [DisplayController::class, 'index']);
    Route::get('/practice/{id}/detail', [DisplayController::class, 'practiceDetail'])->name('practice.detail');
    Route::get('/condition/{id}/detail', [DisplayController::class, 'conditionDetail'])->name('condition.detail');

    Route::get('/create_practice', [RegistrationController::class, 'createPracticeForm'])->name('create.practice');
    Route::post('/create_practice', [RegistrationController::class, 'createPractice']);

    Route::get('/create_condition', [RegistrationController::class, 'createConditionForm'])->name('create.condition');
    Route::post('/create_condition', [RegistrationController::class, 'createCondition']);

    Route::get('/create_category', [RegistrationController::class, 'createCategoryForm'])->name('create.category');
    Route::post('/create_category', [RegistrationController::class, 'createCategory']);

    Route::get('edit_form/{id}/practice', [RegistrationController::class, 'editPracticeForm'])->name('edit.practice');
    Route::post('edit_form/{id}/practice', [RegistrationController::class, 'editPractice']);

    Route::get('delete/{id}/practice', [RegistrationController::class, 'editDeletePractice'])->name('delete.practice');

    Route::get('edit_form/{id}/condition', [RegistrationController::class, 'editConditionForm'])->name('edit.condition');
    Route::post('edit_form/{id}/condition', [RegistrationController::class, 'editCondition']);

    Route::get('delete/{id}/condition', [RegistrationController::class, 'editDeleteCondition'])->name('delete.condition');

});
