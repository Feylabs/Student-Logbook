<?php

use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::view('/data/santri/import','admin.santri.import');
    Route::get('/data/mutabaah/create','MutabaahController@viewAdminCreate');
    Route::get('/data/mutabaah/manage','MutabaahController@viewAdminManage');
    Route::get('/','HomeAdminController@index');

});

Route::post('/santri/import','DataController@importExcelSantri')->name('import_santri');
Route::post('/mutabaah/store','MutabaahController@store')


?>
