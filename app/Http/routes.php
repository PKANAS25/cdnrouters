<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/products', 'PagesController@products');
Route::get('/careers', 'PagesController@careers');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@contactSend');


Route::get('/hrm', 'Auth\AuthController@getLogin');
Route::post('/hrm', 'Auth\AuthController@authenticate');
Route::get('/hrm/logout', 'Auth\AuthController@getLogout');
Route::get('/hrm/errorLogout', 'Auth\AuthController@errorLogout');

Route::group(array('middleware' => 'auth' ), function () {

Route::get('hrm/home', 'HomeController@home');

//---------------------------------UsersController--------------------------------------------------------------------
    Route::get('hrm/users',['uses'=>'UsersController@index']);
	Route::get('hrm/users/{id?}/edit', ['middleware' => 'Superman','uses'=>'UsersController@edit']);    
	Route::post('hrm/users/{id?}/edit',['middleware' => 'Superman','uses'=>'UsersController@update']);

    Route::get('hrm/users/register',['middleware' => 'UserAdd', function () {return view('users.register');}]);
    Route::get('/duplicateCheck', ['uses'=>'UsersController@duplicateCheck']); 
    Route::post('hrm/users/register',['middleware' => 'UserAdd','uses'=>'UsersController@add']);

     
    Route::get('/users/{id?}/disable', ['middleware' => 'UserAdd','uses'=>'UsersController@disable']);

    Route::get('hrm/users/disabled',['middleware' => 'UserAdd','uses'=>'UsersController@usersDisabled']);
    Route::get('/users/{id?}/restore', ['middleware' => 'UserAdd','uses'=>'UsersController@restore']);

    Route::get('/users/{id?}/password', ['middleware' => 'UserAdd','uses'=>'UsersController@passwordChangeView']);
    Route::post('/users/{id?}/password', ['middleware' => 'UserAdd','uses'=>'UsersController@passwordChange']);


    Route::get('users/password/edit/self',function () {return view('users.passwordSelfEdit');});
    Route::post('users/password/edit/self', 'UsersController@passwordSelfUpdate');

//-------------------------------RolesController-----------------------------------------------
	Route::get('hrm/roles', ['middleware' => 'UserAdd','uses'=>'RolesController@index']);
	Route::get('hrm/roles/create', ['middleware' => 'Superman','uses'=>'RolesController@create']);
	Route::post('hrm/roles/create', ['middleware' => 'Superman','uses'=>'RolesController@store']);

//-------------------------------ClientsController-----------------------------------------------    
 
    Route::get('hrm/clients/add', ['middleware' => 'ClientAdd','uses'=>'ClientsController@add']);
    Route::get('/cityLoader', 'ClientsController@cityLoader'); 
    Route::get('/clientAddCheck', 'ClientsController@clientAddCheck');
    Route::post('hrm/clients/add', ['middleware' => 'ClientAdd','uses'=>'ClientsController@save']); 

    Route::get('hrm/clients/{id?}/profile', 'ClientsController@profile');

    Route::get('hrm/clients/index', 'ClientsController@index');

    Route::get('hrm/clients/{id?}/edit', ['middleware' => 'ClientAdd','uses'=>'ClientsController@edit']);
    Route::post('hrm/clients/{id?}/edit', ['middleware' => 'ClientAdd','uses'=>'ClientsController@editProcess']);
    Route::get('/clientEditCheck', 'ClientsController@clientEditCheck');

//-------------------------------ContactsController-----------------------------------------------    

    Route::get('hrm/contacts/{id?}/add', ['middleware' => 'ContactAdd','uses'=>'ContactsController@add']);
    Route::get('/contactAddCheck', 'ContactsController@contactAddCheck');
    Route::post('hrm/contacts/{id?}/add', ['middleware' => 'ContactAdd','uses'=>'ContactsController@save']);

    Route::post('/deleteClientContact', ['middleware' => 'ContactAdd','uses'=>'ContactsController@deleteClientContact']);
    Route::post('/restoreClientContact', ['middleware' => 'ContactAdd','uses'=>'ContactsController@restoreClientContact']);

    Route::get('hrm/contacts/{clientId?}/{contactId?}/edit', ['middleware' => 'ContactAdd','uses'=>'ContactsController@edit']);
    Route::get('/contactEditCheck', 'ContactsController@contactEditCheck');
    Route::post('hrm/contacts/{clientId?}/{contactId?}/edit', ['middleware' => 'ContactAdd','uses'=>'ContactsController@editProcess']);

//-------------------------------ClientsControllerExtra-----------------------------------------------    
 
    Route::get('hrm/clients/filter', 'ClientsControllerExtra@initiate');  
    Route::post('hrm/clients/filter', 'ClientsControllerExtra@filterShow');   

//-------------------------------CallsController-----------------------------------------------    

    Route::get('hrm/calls/{id?}/add',  'CallsController@add');
    Route::post('hrm/calls/{id?}/add',  'CallsController@save');
     Route::get('hrm/calls/{clientId?}/{contactId?}/edit','CallsController@edit');


});