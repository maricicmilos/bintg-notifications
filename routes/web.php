<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
# Login Form
Route::get('/', 'Authentication\AuthController@login')->name('auth.login');

# User Logout
Route::get('/logout', 'Authentication\AuthController@logout')
    ->name('auth.logout')
    ->middleware('auth.user');

# Authenticate User
Route::post('/auth', 'Authentication\AuthController@auth')->name('auth.authenticate');

# Confirmation Page
Route::get('user/confirmation/{confirmation_code}', 'Authentication\AuthController@confirmation')->name('auth.confirmation');

# Register password
Route::post('user/password/set', 'Authentication\AuthController@registerPassword')->name('auth.password.set');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


# Doctors Dashboard View Route
Route::get('/doctor/dashboard', 'AdminController@indexDoctor')->name('doctor.dashboard');

Route::middleware(['auth.user', 'admin'])->group(function () {
    /*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
    # Admin Dashboard View Route
    Route::get('/admin/dashboard', 'AdminController@indexAdmin')->name('admin.dashboard');

    /*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
# Admin dashboard - Users
    Route::get('/users', 'UserController@index')->name('users.index');

# Admin Dashboard - Users Create Form
    Route::get('/users/create', 'UserController@create')->name('users.create');

# Admin Dashboard - User Store
    Route::post('/users/store', 'UserController@store')->name('users.store');

# Admin Dashboard - User Management (Actions - Update, Delete, Show)
    Route::get('/users/management', 'UserController@management')->name('users.management');

# Admin Dashboard - User Profile Details
    Route::get('/users/{id}/profile', 'UserController@view')->name('users.view');

# Admin Dashboard - User Edit Record
    Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');

# Admin Dashboard - User Update
    Route::post('/users/update', 'UserController@update')->name('users.update');

# Admin Dashboard - User Delete
    Route::post('/users/{id}/delete', 'UserController@delete')->name('users.delete');

    /*
    |--------------------------------------------------------------------------
    | Hospitals Routes
    |--------------------------------------------------------------------------
    */
# Admin Dashboard - Hospitals
    Route::get('/hospitals', 'HospitalController@index')->name('hospitals.index');

# Admin Dashboard - Hospital Create Form
    Route::get('/hospitals/create', 'HospitalController@create')->name('hospitals.create');

# Admin Dashboard - Hospital Store
    Route::post('/hospitals/store', 'HospitalController@store')->name('hospitals.store');

# Admin Dashboard - Hospital Management (Actions - Update, Delete, Show)
    Route::get('/hospitals/management', 'HospitalController@management')->name('hospitals.management');

# Admin Dashboard - Hospital Profile Details
    Route::get('/hospitals/{id}/profile', 'HospitalController@view')->name('hospitals.view');

# Admin Dashboard - Hospital Edit Record
    Route::get('/hospitals/{id}/edit', 'HospitalController@edit')->name('hospitals.edit');

# Admin Dashboard - Hospital Update
    Route::post('/hospitals/update', 'HospitalController@update')->name('hospitals.update');

# Admin Dashboard - Hospital Delete
    Route::post('/hospitals/{id}/delete', 'HospitalController@delete')->name('hospitals.delete');
    /*
    |--------------------------------------------------------------------------
    | Roles Routes
    |--------------------------------------------------------------------------
    */
# Admin Dashboard - Roles
    Route::get('/roles', 'RoleController@index')->name('roles.index');

# Admin Dashboard - Roles Create Form
    Route::get('/roles/create', 'RoleController@create')->name('roles.create');

# Admin Dashboard - Hospital Store
    Route::post('roles/store', 'RoleController@store')->name('roles.store');

# Admin Dashboard - Roles Management (Actions - Update, Delete)
    Route::get('/roles/management', 'RoleController@management')->name('roles.management');

# Admin Dashboard - Role Edit Record
    Route::get('/roles/{id}/edit', 'RoleController@edit')->name('roles.edit');

# Admin Dashboard - Role Update
    Route::post('/roles/update', 'RoleController@update')->name('roles.update');

# Admin Dashboard - Role Delete
    Route::post('/roles/{id}/delete', 'RoleController@delete')->name('roles.delete');
    /*
    |--------------------------------------------------------------------------
    | Specialties Routes
    |--------------------------------------------------------------------------
    */
# Admin Dashboard - Specialties
    Route::get('/specialties', 'SpecialtyController@index')->name('specialties.index');

# Admin Dashboard - Specialties Create Form
    Route::get('/specialties/create', 'SpecialtyController@create')->name('specialties.create');

# Admin Dashboard - Specialty Store
    Route::post('specialties/store', 'SpecialtyController@store')->name('specialties.store');

# Admin Dashboard - Specialties Management (Actions - Update, Delete)
    Route::get('/specialties/management', 'SpecialtyController@management')->name('specialties.management');

# Admin Dashboard - Specialty Edit Record
    Route::get('/specialties/{id}/edit', 'SpecialtyController@edit')->name('specialties.edit');

# Admin Dashboard - Specialty Update
    Route::post('/specialties/update', 'SpecialtyController@update')->name('specialties.update');

# Admin Dashboard - Specialty Delete
    Route::post('/specialties/{id}/delete', 'SpecialtyController@delete')->name('specialties.delete');

    /*
    |--------------------------------------------------------------------------
    | Notifications Routes
    |--------------------------------------------------------------------------
    */
# Admin Dashboard - Notifications
    Route::get('/notifications', 'NotificationsController@index')
        ->name('notifications.index')
        ->middleware('auth.user', 'admin');

# Admin Dashboard - Notifications Create Form
    Route::get('/notifications/create', 'NotificationsController@create')->name('notifications.create');

# Admin Dashboard - Notifications Store
    Route::post('notifications/store', 'NotificationsController@store')->name('notifications.store');

# Admin Dashboard - Notifications Management (Actions - View, Update, Delete)
    Route::get('/notifications/management', 'NotificationsController@management')->name('notifications.management');

# Admin Dashboard - Notification Details
    Route::get('/notifications/{id}/view', 'NotificationsController@view')->name('notifications.view');

# Admin Dashboard - Notifications Edit Record
    Route::get('/notifications/{id}/edit', 'NotificationsController@edit')->name('notifications.edit');

# Admin Dashboard - Notifications Update
    Route::post('/notifications/update', 'NotificationsController@update')->name('notifications.update');

# Admin Dashboard - Notifications Delete
    Route::post('/notifications/{id}/delete', 'NotificationsController@delete')->name('notifications.delete');

});

# Doctor Dashboard - Doctors
Route::get('/doctors/notifications', 'DoctorController@notifications')->name('doctors.notifications');

Route::middleware(['auth.user', 'doctor'])->group(function () {
    /*
|--------------------------------------------------------------------------
| User - Doctors Routes
|--------------------------------------------------------------------------
*/

# Doctor Dashboard - Doctors Profile Details
    Route::get('/doctors/{id}/profile', 'DoctorController@view')->name('doctors.view');

# Doctor Dashboard - Doctors Notifications View Page
    Route::get('/doctors/notifications/{id}/view', 'DoctorController@read')->name('doctors.read');

# Doctor Dashboard - Doctors Notifications Mark as Seen
    Route::get('/doctors/notifications/{id}/seen', 'DoctorController@seen')->name('doctors.seen');

});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
