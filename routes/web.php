<?php

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

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group( ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

  Route::get('ProvaInvio', function () {
    Mail::to("egyangel93@gmail.com")->send(new \App\Mail\WelcomeMail("aaaa"));
  });
  Auth::routes(['verify' => false]);


  Route::group(['middleware' => 'auth'], function () {

    // Users Pages
    Route::get('/app-user-index', 'Dashboard\UserManagmentController@index');
    Route::get('/', 'Dashboard\UserManagmentController@index');

    // Route::get('/app-user-create', 'Dashboard\UserManagmentController@create');

    Route::get('/app-user-UpdateOrCreate', 'Dashboard\UserManagmentController@UpdateOrCreate');

    Route::get('/app-user-show/{id}', 'Dashboard\UserManagmentController@show');
    Route::get('/app-user-edit/{id}', 'Dashboard\UserManagmentController@edit');

    Route::delete('/app-user-delete/{id}', 'Dashboard\UserManagmentController@delete');

   // Licensecode Pages
    Route::get('/app-licensecode-index', 'Dashboard\LicensecodeController@index');
    Route::post('/app-licensecode-UpdateOrCreate', 'Dashboard\LicensecodeController@store');
    Route::delete('/app-licensecode-delete/{id}', 'Dashboard\LicensecodeController@delete');



    Route::get('/question', 'Dashboard\QuestionController@index');
    Route::get('/question-edit/{id}', 'Dashboard\QuestionController@edit');
    Route::delete('/question/{id}', 'Dashboard\QuestionController@destroy');


    Route::post('/question', 'Dashboard\QuestionController@store');
    Route::Put('/edit-question-1/{id}', 'Dashboard\QuestionController@update');

    Route::post('/rsmcquestion', 'Dashboard\RSMCQuestionController@store');
    Route::Put('/edit-question-2/{id}', 'Dashboard\RSMCQuestionController@update');

    Route::post('/hazardquestion', 'Dashboard\HazardQuestionController@store');
    Route::Put('/edit-question-3/{id}', 'Dashboard\HazardQuestionController@update');

    Route::post('/hazardpquestion', 'Dashboard\HazardPQuestionController@store');
    Route::Put('/edit-question-4/{id}', 'Dashboard\HazardPQuestionController@update');



    Route::get('/getquestion', 'Dashboard\QuestionController@getaddform');
    Route::get('/getquestions', 'Dashboard\QuestionController@getquestions');

    Route::post('/login/validate', 'Auth\LoginController@validate_api');


    }); // End Auth Middleware Group


}); // End LaravelLocalization Group
