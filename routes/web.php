<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Google\Service\Compute\DisplayDevice;
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

    Route::get('/api', [DisplayController::class, 'createEventForm'])->name('create.event');
    Route::post('/api', [DisplayController::class, 'test']);

    Route::get('/createTeam', [RegistrationController::class, 'createTeamForm'])->name('create.team');
    Route::post('/createTeam', [RegistrationController::class, 'createTeam']);

    Route::get('/addTeam/{id}', [RegistrationController::class, 'addTeamFrom'])->name('add.team');
    Route::post('/addTeam/{id}', [RegistrationController::class, 'addTeam']);

    //ここにルートを記述
    Route::get('/', [DisplayController::class, 'index']);
    // Route::get('/select_team', [DisplayController::class, 'index']); // url: '/user/index/' + userNameと同じ
    Route::get('/user/index/', [DisplayController::class, 'getUsersBySearchName']); // url: '/user/index/' + userNameと同じ

    // Route::get('/search/{name}', [DisplayController::class, 'getUsersBySearchName']);
    // Route::get('/text', [DisplayController::class,'search']); // url: '/user/index/' + userNameと同じ



    Route::get('/practice/{id}/detail', [DisplayController::class, 'practiceDetail'])->name('practice.detail');
    Route::get('/condition/{id}/detail', [DisplayController::class, 'conditionDetail'])->name('condition.detail');

    Route::get('/create_alert', [RegistrationController::class, 'createAlertForm'])->name('create.alert');
    Route::post('/create_alert', [RegistrationController::class, 'createAlert']);
    Route::get('edit_form/{id}/alert', [RegistrationController::class, 'editAlertForm'])->name('edit.alert');
    Route::post('edit_form/{id}/alert', [RegistrationController::class, 'editAlert']);
    Route::get('delete/{id}/alert', [RegistrationController::class, 'editDeleteAlert'])->name('delete.alert');

    Route::get('edit_form/{id}/practice', [RegistrationController::class, 'editPracticeForm'])->name('edit.practice');
    Route::post('edit_form/{id}/practice', [RegistrationController::class, 'editPractice']);
    Route::get('feedback_form/{id}/practice', [RegistrationController::class, 'feedbackPracticeForm'])->name('feedback.practice');
    Route::post('feedback_form/{id}/practice', [RegistrationController::class, 'feedbackPractice']);

    Route::get('delete/{id}/practice', [RegistrationController::class, 'editDeletePractice'])->name('delete.practice');

    Route::get('edit_form/{id}/condition', [RegistrationController::class, 'editConditionForm'])->name('edit.condition');
    Route::post('edit_form/{id}/condition', [RegistrationController::class, 'editCondition']);

    Route::get('feedback_form/{id}/condition', [RegistrationController::class, 'feedbackConditionForm'])->name('feedback.condition');
    Route::post('feedback_form/{id}/condition', [RegistrationController::class, 'feedbackCondition']);
    Route::get('delete/{id}/condition', [RegistrationController::class, 'editDeleteCondition'])->name('delete.condition');

    Route::get('/create_practice', [RegistrationController::class, 'createPracticeForm'])->name('create.practice');
    Route::post('/create_practice', [RegistrationController::class, 'createPractice']);

    Route::get('/create_condition', [RegistrationController::class, 'createConditionForm'])->name('create.condition');
    Route::post('/create_condition', [RegistrationController::class, 'createCondition']);

    Route::get('/create_category', [RegistrationController::class, 'createCategoryForm'])->name('create.category');
    Route::post('/create_category', [RegistrationController::class, 'createCategory']);

    Route::get('/create_schedule', [RegistrationController::class, 'createScheduleForm'])->name('create.schedule');
    Route::post('/create_schedule', [RegistrationController::class, 'createSchedule']);

    Route::get('/schedule', [RegistrationController::class, 'Schedule'])->name('schedule');
    Route::post('/schedule', [RegistrationController::class, 'Schedule']);
    Route::get('edit_form/{id}/schedule', [RegistrationController::class, 'editScheduleForm'])->name('edit.schedule');
    Route::post('edit_form/{id}/schedule', [RegistrationController::class, 'editSchedule']);
    Route::get('delete/{id}/schedule', [RegistrationController::class, 'editDeleteSchedule'])->name('delete.schedule');

    Route::get('/schedule/{id}/detail', [RegistrationController::class, 'scheduleDetail'])->name('schedule.detail');

    Route::get('/{id}', [RegistrationController::class, 'Month'])->name('now.month');
});


    // Route::group(['middleware' => ['auth', 'can:master']], function () {
        //     Route::get('/create_alert', [RegistrationController::class, 'createAlertForm'])->name('create.alert');
        //     Route::post('/create_alert', [RegistrationController::class, 'createAlert']);

    //     Route::get('edit_form/{id}/alert', [RegistrationController::class, 'editAlertForm'])->name('edit.alert');
    //     Route::post('edit_form/{id}/alert', [RegistrationController::class, 'editAlert']);
    //     Route::get('delete/{id}/alert', [RegistrationController::class, 'editDeleteAlert'])->name('delete.alert');
    // });

    // Route::group(['middleware' => ['auth', 'can:player']], function () {
    // });

    // Route::group(['middleware' => ['auth', 'can:coach']], function () {
    // });
