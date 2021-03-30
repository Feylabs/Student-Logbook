<?php

use Illuminate\Support\Facades\Route;



Route::prefix('santri')->group(function () {
    Route::get('/','HomeSantriController@index');


    Route::view('/data/santri/import','admin.santri.import');
    Route::get('/data/mutabaah/create','MutabaahController@viewAdminCreate');
    Route::any('/data/mutabaah/manage','MutabaahController@viewAdminManage');
    Route::any('/data/mutabaah/preview','MutabaahController@viewAdminPreview');
    Route::any('/data/santri/manage','SantriController@viewAdminManage');
    Route::any('/data/santri/{id}/edit','SantriController@viewAdminEdit');


});


?>
