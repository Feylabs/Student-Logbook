<?php

use Illuminate\Support\Facades\Route;

Route::post('/guru/update_password', 'GuruController@guruChangePassword');
Route::post('/guru/updateByGuru', 'GuruController@guruUpdate');
Route::prefix('guru')->group(function () {
    Route::get('/','HomeGuruController@index');
    Route::get('/group','GuruGroupController@init');
    Route::any('/mp3','Mp3StreamingController@viewSantriPreview');

    Route::get('/profile','GuruController@guruViewProfile');

    Route::get('/mutabaah/report','GuruGroupController@init');




});

Route::post('/mutabaah/report/check','ReportMutabaahController@viewCheck')->name('mutabaah.search_filter_all');
Route::get('/mutabaah/report/check','ReportMutabaahController@viewCheck');


?>
