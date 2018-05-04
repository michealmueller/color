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
Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'MembersController@index')->name('home');

Route::group(['middleware'=>'auth'], function(){

    Route::post('/admin/login', 'AdminController@login');

    Route::group(['prefix' => 'admin'], function(){
        Route::get('/', 'AdminController@index')->name('adminhome');

        Route::get('files', 'AdminController@files')->name('files');
        Route::post('files/{id}/remove', 'AdminController@UploadFiles')->name('uploadfiles');
        Route::get('upload', 'AdminController@Upload')->name('upload');
        Route::post('upload', 'AdminController@import');
        Route::get('reports', 'AdminController@ShowReports')->name('reports');
        Route::post('reports', 'AdminController@reports');

        Route::get('directory', 'AdminController@MemberDirectory')->name('directory');
        Route::get('expireddirectory', 'AdminController@ExpiredMembers')->name('expireddirectory');
        Route::get('events', 'AdminController@showEvents')->name('events');
        Route::post('events', 'AdminController@addMembertoEvent');

        Route::get('profile/{id}/terminate', 'AdminController@TerminateMember');
        Route::get('profile/{id}/deactivate', 'AdminController@DeactivateMember');
        Route::get('profile/{id}/activate', 'AdminController@ActivateMember');

        Route::post('profile/{id}/extend', 'AdminController@Extend');

        Route::post('profile/{id}/controls', 'AdminController@AccountControls');

        Route::get('profile/{id}', 'AdminController@ShowMemberProfile')->name('adminprofile');

        Route::post('profile/{id}', 'AdminController@Update');

        Route::get('{id}/edit', 'AdminController@EditMember')->name('adminedit');

        Route::post('{id}/edit', 'AdminController@UpdateMember')->name('adminedit');

        Route::get('{id}/remove', 'AdminController@RemoveMember')->name('adminremove');

        Route::get('expiring', 'AdminController@MembersExpiring')->name('expiring');
        Route::get('new', 'AdminController@NewMembers')->name('newmembers');
        Route::get('renewed', 'AdminController@RenewedMembers')->name('renewedmembers');

        Route::get('addmember', 'AdminController@CreateMember')->name('addmember');
        Route::post('addmember', 'AdminController@AddMember')->name('addmember');

        Route::get('addcompany', 'AdminController@createCompany')->name('addmember');
        Route::post('addcompany', 'AdminController@addCompany')->name('addmember');

        Route::get('export/{id}', 'AdminController@ExportCSV')->name('export');

        Route::get('download/{filename}', 'AdminController@Download')->name('download');

        Route::get('authorize', 'AdminController@AuthorizeList')->name('authorize');
        Route::get('authorize/{id}', 'AdminController@AuthorizeUser');

        Route::get('profileadvert', 'AdminController@AdvertUpload')->name('profileadvert');
        Route::post('profileadvert', 'AdminController@UploadAdvert');
        Route::post('removeadvert/{id}', 'AdminController@removeAdvert');

        Route::get('roving-reports', 'AdminController@RovingReports');
        Route::get('color-forecasts', 'AdminController@Colorforecasts');

        Route::post('color-forecasts', 'AdminController@CreateColorforecasts');

        Route::get('companies', 'CompanyController@index')->name('companylist');
        Route::get('companies/edit/{id}', 'CompanyController@edit')->name('companyedit');

        Route::post('companies/edit/{id}', 'CompanyController@editUpdate');
        Route::post('companies/addmember', 'CompanyController@addMember');
    });

    Route::group(['middleware'=>'subed', 'prefix'=>'members'], function(){
        Route::get('files', 'MemberContentController@GetContent')->name('memberfiles');
        Route::get('muse', 'MemberContentController@Muse');
        Route::get('roving-report', 'MemberContentController@RovingReports')->name('colorreport');;
        Route::get('color-forecast', 'MemberContentController@ColorReports')->name('colorforecast');

        Route::get('directory', 'MembersController@MemberSearch')->name('membersdirectory');
        Route::post('directory/customsearch', 'MembersController@MemberSearch')->name('membersdirectory');

        Route::get('download/{filename}', 'MembersController@Download')->name('download');
    });

    //wpEvent Routes
    Route::get('events/{id}/register', 'EventController@EventRegister');
    

//Subscriptiion Routes
    Route::get('NewSubscription', 'ChargesController@index')->name('billing');
    Route::post('NewSubscription', 'PurchaseController@Subscribe');
    Route::get('CancelSubscription', 'PurchaseController@CancelSubscriptionIndex');
    Route::post('CancelSubscription', 'PurchaseController@CancelSubscription');
    Route::post('NewCharge', 'ChargesController@create');
    Route::post('NewEventCharge', 'ChargesController@EventCharge');
    Route::get('ThankYou', 'PurchaseController@ThankYou');
    Route::get('regcomplete', 'PurchaseController@RegComplete');


    Route::get('profile', 'ProfileController@show')->name('profile');
    Route::post('profile/{id}/genupdate', 'ProfileController@genupdate')->middleware(["subed", "activated"]);
    Route::post('profile/{id}/change-password', 'ProfileController@changePassword')->middleware(["subed", "activated"]);
    Route::post('profile/{id}/contactupdate', 'ProfileController@contactupdate')->middleware(["subed", "activated"]);
    Route::post('profile/check_unique', 'ProfileController@check_unique')->middleware(["subed", "activated"]);
    Route::post('profile/{id}/skillsupdate', 'ProfileController@skillsupdate')->middleware(["subed", "activated"]);
    Route::post('profile/{id}/companyupdate', 'ProfileController@companyupdate')->middleware(["subed", "activated"]);
    Route::post('profile/{id}/companymemberupdate', 'ProfileController@companymemberupdate')->middleware(["subed", "activated"]);
    Route::post('profile/{id}/addcompanymember', 'ProfileController@AddCompanyMember')->middleware(["subed", "activated"]);
    Route::post('profile/{id}/dietupdate', 'ProfileController@dietUpdate')->middleware(["subed", "activated"]);
    Route::post('profile/updateStatus', 'TimelineController@store')->middleware(["subed", "activated"]);
    Route::get('profile/{username}', 'ProfileController@create')->name('memberprofile');


    Route::post('comment/timeline/{timeline_id}', 'CommentsController@store');

    Route::get('follow/{id}', 'FollowsController@store');

    Route::get('academic-upload', 'MembersController@Academic')->name('academic');
    Route::post('academic-upload', 'MembersController@AcademicUpload');
});

Route::get('events/{id}/nonmember/register', 'EventController@NonMemberEventRegister');
Route::post('events/{id}/nonmember/register', 'EventController@NonMemberRegister');

Route::get('verify/resend', 'MembersController@ResendVerification');
Route::get('verify/{hash}/{id}', 'VerificationController@verify');

Route::get('NotAuthorized', 'MembersController@NotAuthorized');
Route::get('NotActivated', 'MembersController@NotActivated');

Route::get('/charts/{name}/{height}', 'ChartsController@show')->name('chart');

Route::get('find', 'SearchController@find');

Route::get('reset', 'ProfileController@resetpass');

Route::get('/digitalcolorreports/{id}/{page}', 'MemberContentController@show');
Route::get('/rovingcolorreports/{id}/{page}', 'MemberContentController@show');
