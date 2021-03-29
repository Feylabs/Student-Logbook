<?php

use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::view('/data/santri/import','admin.santri.import');
    Route::get('/data/mutabaah/create','MutabaahController@viewAdminCreate');
    Route::any('/data/mutabaah/manage','MutabaahController@viewAdminManage');
    Route::any('/data/santri/manage','SantriController@viewAdminManage');
    Route::any('/data/santri/{id}/edit','SantriController@viewAdminEdit');

    
    Route::get('/','HomeAdminController@index');


});

Route::post('/santri/import','DataController@importExcelSantri')->name('import_santri');
Route::post('/santri/update','SantriController@update')->name('import_santri');
Route::delete('/santri/{id}/deleteAjax','SantriController@deleteAjax');


Route::post('/mutabaah/store','MutabaahController@store');

Route::get('/mutabaah/eloquent','MutabaahController@testEloquent');
Route::get('/mutabaah/{id}/fetch','MutabaahController@getById');
Route::post('/mutabaah/{id}/updateAjax','MutabaahController@updateAjax');
Route::delete('/mutabaah/{id}/deleteAjax','MutabaahController@deleteAjax');


?>
