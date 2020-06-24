<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cabinet\AjaxController;
use App\Http\Controllers\Cabinet\SettingsCotroller;
use App\Http\Controllers\JobController;
use Illuminate\Http\Request;

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

Route::get('/', 'HomeController@home')->name('main');
Route::get('/register', 'Auth\RegisterController@showFormRegister')->name('create');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/register/verify_phone', 'Auth\RegisterController@verifyPhone');
Route::post('/register/de_registration', 'Auth\RegisterController@deRegistration');
Route::post('/register/resend_verify_code', 'Auth\RegisterController@resendVerifyCode');

Route::get('/login', 'Auth\LoginController@showFormLogin')->name('show.form.login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/confirm', function (){
    return view('auth.confirmation_email');
})->name('confirmation_email');

Route::get('/cabinet/settings/{token}', 'Cabinet\SettingsCotroller@verifyEmail')->name('verify_email');

Route::get('/result', function (){
    return view('auth.result_register');
})->name('result.register');



Route::get('/cabinet/settings', 'Cabinet\SettingsCotroller@showSettings')->name('cabinet.settings');
Route::post('/cabinet/settings', 'Cabinet\SettingsCotroller@allAction')->name('settings.action');
Route::post('/cabinet/settings/requestPhoneVerifyCode', 'Cabinet\SettingsCotroller@requestPhoneVerifyCode');
Route::post('/cabinet/settings/verify_phone', 'Cabinet\SettingsCotroller@verifyPhone');
Route::post('/cabinet/settings/edit_phone', 'Cabinet\SettingsCotroller@editPhone');
Route::post('/cabinet/settings/do_not_change', 'Cabinet\SettingsCotroller@doNotChange')->name('no');
Route::post('/cabinet/settings/resend_verify_code', 'Cabinet\SettingsCotroller@resendVerifyCode');
Route::post('/cabinet/settings/add_email', 'Cabinet\SettingsCotroller@addEmail');
Route::post('/cabinet/settings/edit_email', 'Cabinet\SettingsCotroller@editEmail');
Route::post('/cabinet/settings/toggle_check', 'Cabinet\SettingsCotroller@toggleCheck');
Route::get('/cabinet/worker', 'Cabinet\MyWorkerController@showMyWorker')->name('cabinet.worker');
Route::get('/cabinet/jobs', 'Cabinet\JobController@showJobs')->name('cabinet.job');
//----------------------------------------------------------------------------------------------------------------------
Route::get('/worker/create/regions', 'WorkerController@getRegions');
Route::post('/worker/create/cities', 'WorkerController@getCitiesOfRegion');
Route::post('/worker/create/city_search', 'WorkerController@getRelevantCities');

Route::get('/worker/create', 'WorkerController@showCreate')->name('worker.create');
Route::get('/worker/create/check', 'WorkerController@showCheck')->name('worker.check');
Route::get('/worker/create/edit', 'WorkerController@showEdit')->name('worker.edit');
Route::post('/worker/create', 'WorkerController@storeDraft')->name('worker.store.draft');
Route::post('/worker/created', 'WorkerController@createAfterCheck')->name('worker.create.after.check');
Route::post('/worker/create/edit', 'WorkerController@editAtCreation')->name('worker.edit.at.creation');
Route::get('/worker/{id}', 'WorkerController@show')->name('worker.item');
Route::get('/workers', 'WorkerController@index')->name('worker.index');
Route::get('/get_open_jobs', 'WorkerController@getAuthenticatedUserJobs');
Route::get('/get_proposed_jobs/{worker_id}', 'WorkerController@getProposedJobs');
Route::get('/get_hired_jobs/{worker_id}', 'WorkerController@getHiredJobs');
Route::post('proposed_job', 'WorkerController@proposedJob');
Route::get('/get_reviews/{worker_id}', 'WorkerController@getReviews');
Route::post('/hired_jobs', 'WorkerController@hiredJobs');
//----------------------------------------------------------------------------------------------------------------------
Route::get('/job/create', 'JobController@create')->name('job.create');
Route::post('/job/create/store', 'JobController@store')->name('job.store');
Route::get('/job/{id}/create/check', 'JobController@check')->name('job.check');
Route::get('job/{id}/create/edit', 'JobController@edit')->name('job.create.edit');
Route::put('job/{id}/update', 'JobController@update')->name('job.update');
Route::put('job/{id}/confirm', 'JobController@confirm')->name('job.confirm');
Route::get('/job/{id}', 'JobController@show')->name('job.show');
Route::get('/job/{id}/edit', 'JobController@edit')->name('job.edit');
Route::get('/jobs', 'JobController@index')->name('job.index');

Route::post('/job/{id}/offer_worker', 'JobController@offerWorker')->name('job.offer.worker');
Route::post('/job/{id}/delete_worker', 'JobController@deleteProposedWorker')->name('job.delete.worker');
Route::get('/job/{id}/cancel', 'JobController@cancel')->name('job.cancel');
Route::post('/job/{job_id}/worker/{worker_id}/hired', 'JobController@hiredWorker')->name('job.hired_worker');
Route::post('/job/{id}/worker/review/create', 'JobController@performed')->name('worker.review.store');

Route::get('/job/create/regions', 'JobController@getRegions');
Route::post('/job/create/cities', 'JobController@getCitiesOfRegion');
Route::post('/job/create/city_search', 'JobController@getRelevantCities');

Route::get('/job/create/categories', 'JobController@getCategories');
Route::post('/job/create/sub_categories', 'JobController@getSubCategoriesOfCategory');
//----------------------------------------------------------------------------------------------------------------------
Route::get('/user/{id}', 'UserController@show')->name('user.show');

Route::post('/cabinet/settings/change_password', 'Cabinet\SettingsCotroller@changePassword');



//Route::post('/cabinet/settings/add_email', 'Cabinet\SettingsCotroller@addEmail');


Route::post('/cabinet/settings/phone_verify', 'Cabinet\SettingsCotroller@verifyPhone')->name('phone.verify');




//Восстановление пароли
Route::get('/forgot/form', 'Auth\ForgotPasswordController@showForgotPassword')->name('show.forgot.password');
Route::post('/reset', 'Auth\ForgotPasswordController@sendLinkResetPassword')->name('send.link.reset.password');


Route::get('/reset/form/{token}', 'Auth\ResetPasswordController@showResetPassword')->name('show.form.reset.password');
Route::post('/reset/form', 'Auth\ResetPasswordController@changePassword')->name('change.password');











