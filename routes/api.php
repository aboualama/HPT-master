<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

  Route::get('/questions/{type}', 'Api\QuestionController@getquestions');
  Route::get('/getAllQuestions', 'Api\QuestionController@getAllQuestions');
  Route::get('/getanswers', 'Api\QuestionController@getanswers');
  Route::post('/storanswers', 'Api\QuestionController@storanswers');
  Route::post('/checklicens', 'Api\AuthController@checklicens');

Route::get('/test' , function(){return  'test'; });

Route::group(['prefix' => 'auth'], function () {
  Route::post('login', 'Api\AuthController@login');
  Route::post('register', 'Api\AuthController@register');

  Route::group(['middleware' => 'auth:api'], function() {
      Route::get('logout', 'Api\AuthController@logout');
      Route::get('user', 'AuthController@user');
  });
});


