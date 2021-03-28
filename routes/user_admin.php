<?php

use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::view('/data/santri/import','admin.santri.import');
    Route::get('/','HomeAdminController@index');

});

Route::post('/santri/import','DataController@importExcelSantri')->name('import_santri');


?>
