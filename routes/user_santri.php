<?php

use Illuminate\Support\Facades\Route;



Route::prefix('santri')->group(function () {
    Route::get('/','HomeSantriController@index');


    Route::view('/data/santri/import','admin.santri.import');
    Route::get('/mutabaah/input','SantriMutabaahController@viewSantriInit');
    Route::get('/mutabaah/input/{id}','SantriMutabaahController@input')->name('santri.mutabaah.input');
    Route::post('/mutabaah/input/{id}','SantriMutabaahController@store')->name('santri.mutabaah.store');
    
    Route::any('/data/mutabaah/manage','MutabaahController@viewAdminManage');
    Route::any('/data/mutabaah/preview','MutabaahController@viewAdminPreview');
    Route::any('/data/santri/manage','SantriController@viewAdminManage');
    Route::any('/data/santri/{id}/edit','SantriController@viewAdminEdit');


});


?>
