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




Route::get('/getQuestionEntro/{type}', 'Api\QuestionController@getQuestionEntro');


// Route::get('/test' , function(){return  'test'; });

Route::group(['prefix' => 'auth'], function () {

  Route::post('login', 'AuthController@login');
  Route::post('register', 'AuthController@register');
  Route::get('email/verify/{id}', 'VerificationApiController@verify')->name('verificationapi.verify');
  Route::get('email/resend', 'VerificationApiController@resend')->name('verificationapi.resend');

});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function() {

  Route::get('/questions/{type}', 'QuestionController@getquestions');
  Route::get('/getAllQuestions', 'QuestionController@getAllQuestions');
  Route::get('/getanswers', 'QuestionController@getanswers');
  Route::post('/storanswers', 'QuestionController@storanswers');
  Route::post('/LicenseInactive/{id}', 'LicensecodeController@LicenseInactive');
  Route::post('/getResultBylisence', 'QuestionController@getResultByLisence');
  Route::post('/updateanswers', 'QuestionController@updateanswers');


  Route::post('/checklicens', 'AuthController@checklicens');
  Route::post('/requestLicenseMail', 'AuthController@requestLicense');


  Route::get('user', 'AuthController@user');
  Route::get('logout', 'AuthController@logout');


  Route::post('/getResultByLicenceCode', 'ResultController@getResultByLicenceCode');
  Route::get('/getResultByLicenceCode/{id}', 'ResultController@getResultByLicenceCodeId');
});
