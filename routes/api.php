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

  Route::post('/questions/{type}', 'Api\QuestionController@getquestions');
  Route::get('/getAllQuestions', 'Api\QuestionController@getAllQuestions');
  Route::get('/getanswers', 'Api\QuestionController@getanswers');
  Route::post('/storanswers', 'Api\QuestionController@storanswers');

  Route::post('/checklicens', 'Api\LicensecodeController@checklicens');
  Route::post('/LicenseInactive/{id}', 'Api\LicensecodeController@LicenseInactive');
  Route::post('/updateanswers', 'Api\QuestionController@updateanswers');
 // TODO check whic checklicens work
  Route::post('/checklicens', 'Api\AuthController@checklicens');
  Route::post('/requestLicenseMail', 'Api\AuthController@requestLicense');

// Route::get('/test' , function(){return  'test'; });

Route::group(['prefix' => 'auth'], function () {
  Route::post('login', 'Api\AuthController@login');
  Route::post('register', 'Api\AuthController@register');
  Route::get('email/verify/{id}', 'Api\VerificationApiController@verify')->name('verificationapi.verify');
  Route::get('email/resend', 'Api\VerificationApiController@resend')->name('verificationapi.resend');

  Route::group(['middleware' => 'auth:api'], function() {
      Route::get('logout', 'Api\AuthController@logout');
      Route::get('user', 'AuthController@user');
  });
});


